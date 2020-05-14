@csrf
      <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
      <fieldset class="control">
        <label>Name</label>
        <input type="text" class="input" name="title" class="form-control" placeholder="Enter sourdough's name" value="{{ $sourdough->title }}" required>
      </fieldset>
      <fieldset class="control">
        <label>Weight</label>
        <input type="text" class="input" name="weight" class="form-control" placeholder="Enter sourdough's weight"  value="{{ $sourdough->weight }}" required>
      </fieldset>
      <fieldset class="control">
            <label>Humidity</label>
            <input type="text" class="input" name="humidity" class="form-control" placeholder="Enter sourdough's humidity"  value="{{ $sourdough->humidity }}" required>
          </fieldset>
      <button type="submit" class="button button-primary">{{ $buttonText }}</button>
