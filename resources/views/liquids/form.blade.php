@csrf
      <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
      <fieldset class="control">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="input" name="title" class="form-control" placeholder="Enter liquid's name" value="{{ $liquid->title }}" required>
      </fieldset>
      <fieldset class="control">
        <label for="exampleInputEmail1">Weight</label>
        <input type="text" class="input" name="weight" class="form-control" placeholder="Enter liquid's weight"  value="{{ $liquid->weight }}" required>
      </fieldset>
      <button type="submit" class="button button-primary">{{ $buttonText }}</button>
