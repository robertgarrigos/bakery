@csrf
      <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
      <fieldset class="control">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="input" name="title" class="form-control" placeholder="Enter other's name" value="{{ $other->title }}" required>
      </fieldset>
      <fieldset class="control">
        <label for="exampleInputEmail1">Weight</label>
        <input type="text" class="input" name="weight" class="form-control" placeholder="Enter other's weight"  value="{{ $other->weight }}" required>
      </fieldset>
      <button type="submit" class="button button-primary">{{ $buttonText }}</button>
