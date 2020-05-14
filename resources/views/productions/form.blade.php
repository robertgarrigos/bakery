@csrf
<input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
<input type="hidden" name="title" value="{{ $recipe->title }}">
<div class="field">
    <label class="label">Number of pieces</label>
    <fieldset class="control">
        <input type="text" class="input" name="pieces_number" placeholder="Enter number of pieces"
            value="{{ $production->pieces_number }}" required>
    </fieldset>
</div>
<div class="field">
    <label class="label">Weight of pieces</label>
    <fieldset class="control">
        <input type="text" class="input" name="pieces_weight" placeholder="Enter weight of pieces"
            value="{{ $production->pieces_weight }}" required>
    </fieldset>
</div>
<div class="field">
    <label class="label">Pieces final</label>
    <fieldset class="control">
        <input type="text" class="input" name="pieces_final" placeholder="Enter number of pieces finally baked"
            value="{{ $production->pieces_final }}">
    </fieldset>
</div>
<div class="field">
    <label for="" class="label">Notes</label>
    <fieldset class="control">
        <textarea name="notes" id="" cols="30" rows="10" class="textarea">@if (filled($production->notes)){{ $production->notes }}@else{{ $recipe->notes }}@endif</textarea>
    </fieldset>
</div>
<div class="field is-grouped">
    <div class="control">
        <button type="submit" class="button is-info">{{ $buttonText }}</button>
    </div>
    @include('includes.cancel')
</div>
