<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventQuestionRequest;
use App\Models\Attendee;
use App\Models\Event;
use App\Models\Question;
use App\Models\QuestionAnswer;
use App\Models\QuestionType;
use Excel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use JavaScript;

/*
  Attendize.com   - Event Management & Ticketing
 */

class EventSurveyController extends MyBaseController
{
    /**
     * Show the event survey page
     */
    public function showEventSurveys(Request $request, $event_id): View
    {
        $event = Event::scope()->findOrFail($event_id);

        JavaScript::put([
            'postUpdateQuestionsOrderRoute' => route('postUpdateQuestionsOrder', ['event_id' => $event_id]),
        ]);

        $data = [
            'event' => $event,
            'questions' => $event->questions->sortBy('sort_order'),
            'sort_order' => 'asc',
            'sort_by' => 'title',
            'q' => '',
        ];

        return view('ManageEvent.Surveys', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showCreateEventQuestion(Request $request, $event_id): View
    {
        $event = Event::scope()->findOrFail($event_id);

        return view('ManageEvent.Modals.CreateQuestion', [
            'event' => $event,
            'question_types' => QuestionType::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCreateEventQuestion(StoreEventQuestionRequest $request, $event_id): JsonResponse
    {
        // Get the event or display a 'not found' warning.
        $event = Event::findOrFail($event_id);

        // Create question.
        $question = Question::createNew(false, false, true);
        $question->title = $request->get('title');
        $question->is_required = (bool) $request->get('is_required', false);
        $question->question_type_id = $request->get('question_type_id');
        $question->save();

        // Get options.
        $options = $request->get('option');

        // Add options.
        if ($options && is_array($options)) {
            foreach ($options as $option_name) {
                if (trim($option_name) !== '') {
                    $question->options()->create([
                        'name' => $option_name,
                    ]);
                }
            }
        }

        // Get tickets.
        $ticket_ids = $request->get('tickets');

        $question->tickets()->attach($ticket_ids);

        $event->questions()->attach($question->id);

        session()->flash('message', trans('Controllers.successfully_created_question'));

        return response()->json([
            'status' => 'success',
            'message' => trans('Controllers.refreshing'),
            'redirectUrl' => '',
        ]);
    }

    /**
     * Show the Edit Question Modal
     */
    public function showEditEventQuestion(Request $request, $event_id, $question_id): View
    {
        $question = Question::scope()->findOrFail($question_id);
        $event = Event::scope()->findOrFail($event_id);

        $data = [
            'question' => $question,
            'event' => $event,
            'question_types' => QuestionType::all(),
        ];

        return view('ManageEvent.Modals.EditQuestion', $data);
    }

    /**
     * Edit a question
     */
    public function postEditEventQuestion(Request $request, $event_id, $question_id): JsonResponse
    {
        // Get the event or display a 'not found' warning.
        $event = Event::scope()->findOrFail($event_id);

        // Create question.
        $question = Question::scope()->findOrFail($question_id);
        $question->title = $request->get('title');
        $question->is_required = (bool) $request->get('is_required', false);
        $question->question_type_id = $request->get('question_type_id');
        $question->save();

        $question_type = QuestionType::find($question->question_type_id);

        if ($question_type->has_options) {

            // Get options.
            $options = $request->get('option');

            $question->options()->delete();

            // Add options.
            if ($options && is_array($options)) {
                foreach ($options as $option_name) {
                    if (trim($option_name) !== '') {
                        $question->options()->create([
                            'name' => $option_name,
                        ]);
                    }
                }
            }
        }

        // Get tickets.
        $ticket_ids = (array) $request->get('tickets');

        $question->tickets()->sync($ticket_ids);

        session()->flash('message', trans('Controllers.successfully_edited_question'));

        return response()->json([
            'status' => 'success',
            'message' => trans('Controllers.refreshing'),
            'redirectUrl' => '',
        ]);

    }

    /**
     * Delete a question
     */
    public function postDeleteEventQuestion(Request $request, $event_id): JsonResponse
    {
        $question_id = $request->get('question_id');

        $question = Question::scope()->find($question_id);

        $question->answers()->delete();

        if ($question->delete()) {

            session()->flash('message', trans('Controllers.successfully_deleted_question'));

            return response()->json([
                'status' => 'success',
                'message' => trans('Controllers.refreshing'),
                'redirectUrl' => '',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'id' => $question->id,
            'message' => trans('Controllers.this_question_cant_be_deleted'),
        ]);
    }

    /**
     * Show all attendees answers to questions
     */
    public function showEventQuestionAnswers(Request $request, $event_id, $question_id): View
    {
        $answers = QuestionAnswer::scope()->where('question_id', $question_id)->get();
        $question = Question::scope()->withTrashed()->find($question_id);

        $attendees = Attendee::scope()
            ->has('answers')
            ->where('event_id', $event_id)
            ->get();

        $data = [
            'answers' => $answers,
            'question' => $question,
        ];

        return view('ManageEvent.Modals.ViewAnswers', $data);
    }

    /**
     * Export answers to xls, csv etc.
     */
    public function showExportAnswers(Request $request, $event_id, string $export_as = 'xlsx')
    {
        Excel::create('answers-as-of-'.date('d-m-Y-g.i.a'), function ($excel) use ($event_id) {

            $excel->setTitle(trans('Controllers.survey_answers'));

            // Chain the setters
            $excel->setCreator(config('attendize.app_name'))
                ->setCompany(config('attendize.app_name'));

            $excel->sheet('survey_answers_sheet_', function ($sheet) use ($event_id) {

                $event = Event::scope()->findOrFail($event_id);

                $sheet->fromArray($event->survey_answers, null, 'A1', false, false);

                // Set gray background on first row
                $sheet->row(1, function ($row) {
                    $row->setBackground('#f5f5f5');
                });
            });
        })->export($export_as);
    }

    /**
     * Toggle the enabled status of question
     */
    public function postEnableQuestion(Request $request, $event_id, $question_id): JsonResponse
    {
        $question = Question::scope()->find($question_id);

        $question->is_enabled = ($question->is_enabled == 1) ? 0 : 1;

        if ($question->save()) {
            return response()->json([
                'status' => 'success',
                'message' => trans('Controllers.successfully_updated_question'),
                'id' => $question->id,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'id' => $question->id,
            'message' => trans('basic.whoops'),
        ]);
    }

    /**
     * Updates the sort order of event questions
     */
    public function postUpdateQuestionsOrder(Request $request): JsonResponse
    {
        $question_ids = $request->get('question_ids');
        $sort = 1;

        foreach ($question_ids as $question_id) {
            $question = Question::scope()->find($question_id);
            $question->sort_order = $sort;
            $question->save();
            $sort++;
        }

        return response()->json([
            'status' => 'success',
            'message' => trans('Controllers.successfully_updated_question_order'),
        ]);
    }
}
