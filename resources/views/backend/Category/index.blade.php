@extends('backend.layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Main Categories</h2>

    {{-- Form for Create/Update --}}
    <div class="card mb-4">
        <div class="card-header">
            {{ isset($editCategory) ? 'Edit Category' : 'Create Category' }}
        </div>
        <div class="card-body">
            <form action="{{ isset($editCategory) ? route('main-category.update', $editCategory->id) : route('main-category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($editCategory))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $editCategory->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                    @if(isset($editCategory) && $editCategory->image)
                        <div class="mt-2">
                            <img src="{{ asset($editCategory->image) }}" width="100" alt="Current Image">
                        </div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($editCategory) ? 'Update' : 'Create' }}
                </button>
                @if(isset($editCategory))
                    <a href="{{ route('main-category.index') }}" class="btn btn-secondary">Cancel</a>
                @endif
            </form>
        </div>
    </div>

    {{-- Table of Categories --}}
    <div class="card">
        <div class="card-header">Category List</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                @if($category->image)
                                    <img src="{{ asset($category->image) }}" width="60" alt="Image">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editCategoryModal"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-image="{{ $category->image ? asset($category->image) : '' }}">
                                    Edit
                                </button>

                                <form action="{{ route('main-category.destroy', $category->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No categories found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal for Edit Category -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editCategoryForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="category-id">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" id="category-name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Image (optional)</label>
                        <input type="file" name="image" id="category-image" class="form-control">
                        <img src="" id="current-image" class="mt-2" width="100" style="display:none;" alt="Current Image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const editCategoryModal = document.getElementById('editCategoryModal');
    editCategoryModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const categoryId = button.getAttribute('data-id');
        const categoryName = button.getAttribute('data-name');
        const categoryImage = button.getAttribute('data-image');

        // Use route helper and replace :id
        const routeTemplate = "{{ route('main-category.update', ':id') }}";
        const updateUrl = routeTemplate.replace(':id', categoryId);
        document.getElementById('editCategoryForm').action = updateUrl;

        document.getElementById('category-id').value = categoryId;
        document.getElementById('category-name').value = categoryName;

        const imgElement = document.getElementById('current-image');
        if (categoryImage) {
            imgElement.src = categoryImage;
            imgElement.style.display = 'block';
        } else {
            imgElement.style.display = 'none';
        }
    });
</script>

@endsection
