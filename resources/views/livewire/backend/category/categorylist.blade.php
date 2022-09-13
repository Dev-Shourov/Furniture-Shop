<div>
    <div class="container-fluid py-4">
        <div class="row">
            <!-- ::: Content Start ::: -->
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="card-header pb-0">
                            <h6>Category table</h6>
                        </div>
                        <button class="btn bg-gradient-primary mt-3 w-20 mar-r-20" wire:click.prevent="addCat">
                        <i class='bx bx-plus-circle mar-r-3 font-12'></i>Add New Category</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                      <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                            <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7">Sl</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category Image</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                             <td>
                                <p class="text-xs text-center font-weight-bold mb-0">1</p>
                             </td>
                             <td>
                                <div class="pad-l-20">
                                    <img src="{{ asset('myUpload/category/'.$category->cat_image) }}" class="avatar avatar-md" alt="user2">
                                </div>
                             </td>
                             <td>
                                <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">{{ $category->cat_name }}</h6>
                                </div>
                                </div>
                             </td>
                             <td class="align-middle  text-center">
                                <a href="" wire:click.prevent="editCat({{ $category }})" class="mar-r-10 c-violet text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class='icon-list bx bx-edit mar-r-3'></i>Edit
                                </a>
                                <a href="" wire:click.prevent="confirmDel({{ $category }})" class="text-secondary c-red font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                    <i class='icon-list bx bx-trash mar-r-3' ></i>Delete
                                </a>
                             </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                      <!--Form Modal Starts-->
                      <div class="modal mod-op fade" id="form" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">
                                    @if($showUpdateModal === true)
                                        <span>Update Category</span>
                                    @else
                                        <span>Add New Category</span>
                                    @endif
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="" autocomplete="off" wire:submit.prevent="{{ $showUpdateModal ? 'updateCat' : 'createCat' }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Category Name</label>
                                            <input type="text" 
                                                class="form-control" 
                                                id="exampleFormControlInput1"
                                                wire:model.defer="catData.cat_name" 
                                                required="required">
                                        </div>
                                        <div class="mb-3">
                                            <x-form.filepond 
                                                wire:model.defer="catData.cat_image" 
                                                allowFileTypeValidation
                                                acceptedFileTypes="['image/png', 'image/jpg', 'image/jpeg']"
                                                allowFileSizeValidation
                                                maxFileSize="4mb"/>
                                            @error('image')
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="closeModal">Close</button>
                                        <button type="submit" class="btn btn-primary">
                                        @if($showUpdateModal)
                                            <span>Update Category</span>
                                        @else
                                            <span>Add Category</span>
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
                                    Category Modal
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this category
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click.prevent="closeModal">Cancle</button>
                                    <button type="button" wire:click.prevent="deleteCat" class="btn btn-primary">Delete</button>
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

