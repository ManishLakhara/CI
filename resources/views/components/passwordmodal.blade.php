<div class="modal fade" id="passwordModal-{{ $user_id }}" tabindex="-1" role="dialog"
    aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <form action="{{ route($form_action, $user_id) }}" method="post" id="form2">
                @csrf
                @method('POST')
                <div>
                    <div class="d-flex justify-content-between">
                        <div class="py-2 text-start">
                            Change Password
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="border:none;background:none">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">

                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter Old Password" name="old_password">
                        </div>
                        <div class="col-12 mt-4">

                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter new Password" name="password">
                        </div>
                        <div class="col-12 mt-4">

                            <input type="password" class="form-control" id="exampleInputPassword1"
                                placeholder="Enter confirm Password" name="confirm_password">
                        </div>
                    </div>

                </div>

                <div class="d-flex py-4 justify-content-end">
                    <div class="px-1">
                        <button type="button" class="btn btn-outline-secondary px-4" style="border-radius: 23px"
                            data-dismiss="modal">Close</button>
                    </div>
                    <div class="px-1">
                        <button type="submit" class="btn btn-outline effects px-4"
                            style="border-color: #f88634 ;border-radius: 23px; color: #f88634" form="form2">Change
                            Password</button>
                    </div>

                </div>
            </form>
        </div>

    </div>
</div>
