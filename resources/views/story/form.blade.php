<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $story->title) }}" />
    @error('title')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group">
    <label for="body">Body</label>
    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="5">{{ old('body', $story->body) }}</textarea>
    @error('body')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group">
    <label for="type">Type</label>
    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
        <option value="">Please Select</option>
        <option value="short" {{ 'short' == old('type', $story->type) ? 'selected' : '' }}>Short</option>
        <option value="long" {{ 'long' == old('type', $story->type) ? 'selected' : '' }}>Long</option>
    </select>
    @error('type')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>
<div class="form-group">
    <label>Status</label>
    <div class="form-check @error('status') is-invalid @enderror">
        <input class="form-check-input" type="radio" name="status" id="status-0" value="0" {{ '0' == old('status', $story->status) ? 'checked' : '' }} />
        <label class="form-check-label" for="status-0">Hide</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="status" id="status-1" value="1" {{ '1' == old('status', $story->status) ? 'checked' : '' }} />
        <label class="form-check-label" for="status-1">Visible</label>
    </div>
    @error('status')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
</div>

<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"  />
    @error('image')
    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
    @enderror
    <img src="{{ $story->thumbnail }}" />
</div>
