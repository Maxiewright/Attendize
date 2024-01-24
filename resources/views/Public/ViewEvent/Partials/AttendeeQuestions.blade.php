@foreach($ticket->questions->where('is_enabled', 1)->sortBy('sort_order') as $question)
    <div class="col-md-12">
        <div class="form-group">
            {{ html()->label($question->title, "ticket_holder_questions[{$ticket->id}][{$i}][{$question->id}]")->class($question->is_required ? 'required' : '') }}

            @if($question->question_type_id == config('attendize.question_textbox_single'))
                {{ html()->text("ticket_holder_questions[{$ticket->id}][{$i}][{$question->id}]")->class("ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control") }}
            @elseif($question->question_type_id == config('attendize.question_textbox_multi'))
                {{ html()->textarea("ticket_holder_questions[{$ticket->id}][{$i}][{$question->id}]")->rows(5)->class("ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  form-control") }}
            @elseif($question->question_type_id == config('attendize.question_dropdown_single'))
                {{ html()->select("ticket_holder_questions[{$ticket->id}][{$i}][{$question->id}]", array_merge(['' => '-- Please Select --'], $question->options->pluck('name', 'name')->toArray()))->class("ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control") }}
            @elseif($question->question_type_id == config('attendize.question_dropdown_multi'))
                {{ html()->multiselect("ticket_holder_questions[{$ticket->id}][{$i}][{$question->id}][]", $question->options->pluck('name', 'name'))->class("ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}   form-control") }}
            @elseif($question->question_type_id == config('attendize.question_checkbox_multi'))
                <br>
                @foreach($question->options as $option)
                    <?php
                        $checkbox_id = md5($ticket->id.$i.$question->id.$option->name);
                    ?>
                    <div class="custom-checkbox">
                        {{ html()->checkbox("ticket_holder_questions[{$ticket->id}][{$i}][{$question->id}][]", false, $option->name)->class("ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  ")->id($checkbox_id) }}
                        <label for="{{ $checkbox_id }}">{{$option->name}}</label>
                    </div>
                @endforeach
            @elseif($question->question_type_id == config('attendize.question_radio_single'))
                <br>
                @foreach($question->options as $option)
                    <?php
                    $radio_id = md5($ticket->id.$i.$question->id.$option->name);
                    ?>
                <div class="custom-radio">
                    {{ html()->radio("ticket_holder_questions[{$ticket->id}][{$i}][{$question->id}]", false, $option->name)->id($radio_id)->class("ticket_holder_questions.{$ticket->id}.{$i}.{$question->id}  ") }}
                    <label for="{{ $radio_id }}">{{$option->name}}</label>
                </div>
                @endforeach
            @endif

        </div>
    </div>
@endforeach
