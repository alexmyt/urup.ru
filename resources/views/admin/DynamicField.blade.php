<div class="container">
	<div class="row">
		<input type="hidden" name="count" value="1" />
        <div class="control-group" id="{{$field}}">
            <label class="control-label" for="{{$field}}1">{{$label}}</label>
            <div class="controls" id="{{$field}}"> 
                  @if($model->{$field})
										@for($index=1;$index<=count($model->{$field});$index++)
										<div class="entry input-group col-xs-3">
											<input class="form-control" name="{{$field}}[]" type="text" placeholder="" value="{{$model->{$field}[$index-1]}}"/>
											<span class="input-group-btn">
														<button class="btn btn-success btn-add" type="button">
																<span class="glyphicon {{$index==count($model->{$field}) ? 'glyphicon-plus' : 'glyphicon-minus'}}"></span>
														</button>
												</span>
										</div>
										@endfor
									@else
										<div class="entry input-group col-xs-3">
											<input class="form-control" name="{{$field}}[]" type="text" placeholder=""/>
											<span class="input-group-btn">
														<button class="btn btn-success btn-add" type="button">
																<span class="glyphicon glyphicon-plus"></span>
														</button>
												</span>
										</div>
									@endif
            </div>
            <br>
            <small>Press + to add another form field :)</small>
              {{var_dump($model->{$field})}}
        </div>
	</div>
</div>

@push('footer-scripts')
<script>
$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('.entry:first').remove();

		e.preventDefault();
		return false;
	});
});
</script>
@endpush