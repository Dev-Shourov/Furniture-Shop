<div>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- ::: Content Start ::: -->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>Product table</h6>
                        </div>
                        <button class="btn bg-gradient-primary mt-3 w-20 mar-r-20" wire:click.prevent="addProduct">
                        <i class='bx bx-plus-circle mar-r-3 font-12'></i>Add New Product</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                            <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Sl</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @foreach($products as $product)
                            <tr>
                             <td>
                                <p class="text-xs text-center font-weight-bold mb-0">{{ $i++ }}</p>
                             </td>
                             <td>
                                <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $product->prod_name }}</h6>
                                </div>
                                </div>
                             </td>
                             <td class="align-middle  text-center">
                                <a href="" wire:click.prevent="editProduct({{ $product }})" class="mar-r-10 c-violet text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class='icon-list bx bx-edit mar-r-3'></i>Edit
                                </a>
                                <a href="" wire:click.prevent="confirmDel({{ $product }})" class="text-secondary c-red font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class='icon-list bx bx-trash mar-r-3' ></i>Delete
                                </a>
                             </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      @if($products->count() == 0)
                        <div class="alert alert-info text-center mar-t-20">
                            <span class="font-14 text-white">No tag found. Please add a new tag</span>
                        </div>
                      @endif
                      <!--Form Modal Starts-->
                      <div class="modal mod-op fade" id="form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">
                                    @if($showUpdateModal === true)
                                        <span>Update Product</span>
                                    @else
                                        <span>Add New Product</span>
                                    @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" autocomplete="off" wire:submit.prevent="{{ $showUpdateModal ? 'updateProduct' : 'createProduct' }}">
                                    <div class="modal-body">
                                        <!-- row starts -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Product Name</label>
                                                    <input type="text" 
                                                        class="form-control" 
                                                        id="exampleFormControlInput1"
                                                        wire:model.defer="prodData.prod_name" 
                                                        required="required">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Product Price</label>
                                                    <input type="number" 
                                                        class="form-control" 
                                                        id="exampleFormControlInput1"
                                                        wire:model.defer="prodData.prod_name" 
                                                        required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- row ends -->
                                        <!-- row starts -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Select Category</label>
                                                    <select class="form-select" 
                                                        id="inputGroupSelect01"
                                                        wire:model.defer="prodData.prod_name" 
                                                        required="required">
                                                        <option selected>Choose...</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Select Tags</label>
                                                    <input type="number" 
                                                        class="form-control" 
                                                        id="exampleFormControlInput1"
                                                        wire:model.defer="prodData.prod_name" 
                                                        required="required">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- row ends -->
                                        
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Tag Name</label>
                                            <input type="text" 
                                                class="form-control" 
                                                id="exampleFormControlInput1"
                                                wire:model.defer="tagData.tag_name" 
                                                required="required">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="closeModal">Close</button>
                                        <button type="submit" class="btn btn-primary">
                                        @if($showUpdateModal)
                                            <span>Update Tag</span>
                                        @else
                                            <span>Add Tag</span>
                                        @endif
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                      </div>
                      <!--Form Modal Ends-->

                      <!-- Confirm Modal Starts -->
                      <div class="modal mod-op fade" id="confirmModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">
                                    Tag Modal
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this tag?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="closeModal">Cancle</button>
                                    <button type="button" wire:click.prevent="deleteProduct" class="btn btn-primary">Delete</button>
                                </div>
                            </div>
                        </div>
                      </div>
                      <!-- Confirm Modal Ends -->
                    </div>
                    </div>
                </div>
            </div>
            <!-- ::: Content End ::: -->
        </div>
    </div>
</div>
