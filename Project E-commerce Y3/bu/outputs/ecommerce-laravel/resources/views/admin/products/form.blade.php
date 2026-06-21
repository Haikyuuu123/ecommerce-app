@csrf
<div class="form-grid">
    <div class="field">
        <label>Name</label>
        <input name="name" value="{{ old('name', $product->name) }}" required>
    </div>
    <div class="field">
        <label>Category</label>
        <select name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="field">
        <label>Price</label>
        <input type="number" step="0.01" min="0" name="price" value="{{ old('price', $product->price) }}" required>
    </div>
    <div class="field">
        <label>Stock</label>
        <input type="number" min="0" name="stock" value="{{ old('stock', $product->stock) }}" required>
    </div>
    <div class="field full">
        <label>Image URL</label>
        <input name="image_url" value="{{ old('image_url', $product->image_url) }}">
    </div>
    <div class="field full">
        <label>Description</label>
        <textarea name="description" required>{{ old('description', $product->description) }}</textarea>
    </div>
    <label><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured))> Featured</label>
    <label><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active ?? true))> Active</label>
    <div class="field full">
        <button class="btn" type="submit">Save product</button>
    </div>
</div>
