@csrf
<div class="field">
    <label class="label">Name</label>
    <fieldset class="control">
        <input type="text" class="input" name="title" placeholder="Enter recipe's name" value="{{ $recipe->title }}"
            required>
    </fieldset>

</div>
<div class="field">
        <label for="" class="label">Notes</label>
        <fieldset class="control">
            <textarea name="notes" id="" cols="30" rows="10" class="textarea">{{ $recipe->notes }}</textarea>
        </fieldset>
    </div>
<div class="field is-grouped">
    <div class="control">
        <button type="submit" class="button is-info">Submit</button>
    </div>
    @include('includes.cancel')
</div>
