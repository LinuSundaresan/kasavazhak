@php
    $popularCategorySection = json_decode($popularCategories->value ?? '[]');
@endphp

<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control main-category" data-height="100%" name="cat_one">
                                <option value="">--Select--</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select class="form-control sub-category" data-height="100%" name="sub_cat_one">

                                @php
                                    $subcategories = \App\Models\SubCategory::where('category_id', $popularCategorySection[0]->category)->get();

                                @endphp
                                <option>--Select--</option>



                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Child Category</label>
                            <select class="form-control child-category" data-height="100%" name="child_cat_one">
                                <option>--Select--</option>


                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function (e) {

            $('body').on('change', '.main-category', function () {

                let id = $(this).val();
                let row = $(this).closest('.row');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.get-subcategories') }}",
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        let selector = row.find('.sub-category');
                        selector.html('<option >--Select--</option>');
                        $.each(data, function (i, item) {
                            selector.append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });

            });

            $('body').on('change', '.sub-category', function () {

                let id = $(this).val();
                let row = $(this).closest('.row');

                $.ajax({
                    method: 'GET',
                    url: "{{ route('admin.product.get-child-categories') }}",
                    data: {
                        'id': id
                    },
                    success: function (data) {
                        let selector = row.find('.child-category');
                        selector.html('<option >--Select--</option>');
                        $.each(data, function (i, item) {
                            selector.append(`<option value="${item.id}">${item.name}</option>`);
                        });
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                    }
                });

            });

        });

    </script>
@endpush