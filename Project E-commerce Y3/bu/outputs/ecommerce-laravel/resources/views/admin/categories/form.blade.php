@csrf
<div class="form-grid">
    <div class="field">
        <label>Name</label>
        <input name="name" value="{{ old('name', $category->name) }}" required>
    </div>
    <div class="field full">
        <label>Description</label>
        <textarea name="description">{{ old('description', $category->description) }}</textarea>
    </div>
    <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true))> Active</label>
    <div class="field full">
        <button class="btn" type="submit">Save category</button>
    </div>
</div>
