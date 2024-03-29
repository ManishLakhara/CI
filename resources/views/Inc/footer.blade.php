<footer>
    <hr>
    <div class="position-sticky container policy" style="bottom: 0; z-index: 1">
        <div class="d-flex col">
            <a class="no-decor text-muted" href="{{ route('policy-page') }}"> Privacy Policy</a>
            <div class="col-md-2 px-4 text-muted ">
                <a class="no-decor text-muted " href="#" data-toggle="modal" data-target="#contactusModal"> Contact
                    Us</a>
            </div>
        </div>
    </div>
    @auth
        <div class="modal fade" id="contactusModal" tabindex="-1" role="dialog" aria-labelledby="contactusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-3">
                    <form id="contactusform" method="post">
                        @csrf
                        @method('POST')
                        <div>
                            <div class="d-flex justify-content-between">
                                <div class="py-2 text-start">
                                    Contact Us
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                                    style="border:none;background:none">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="row">
                                <div class="col-12 mt-4">
                                    <label for="name" class="form-label">Name*</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your name"
                                        name="name" value="{{ Auth::user()->first_name }} {{Auth::user()->last_name }}" disabled>
                                </div>
                                <div class="col-12 mt-4">
                                    <label for="email" class="form-label">Email Address*</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                        name="email" value="{{ Auth::user()->email }}" disabled>
                                </div>
                                <div class="col-12 mt-2">
                                    <label for="subject" class="form-label">Subject*</label>
                                    <input type="text" class="form-control" id="subject"
                                        placeholder="Enter your Subject" name="subject">
                                </div>
                                <div class="col-12 mt-2">
                                    <label for="message" class="form-label">Message*</label>
                                    <textarea class="form-control mt-2" id="message" name="message" placeholder="Enter your message..." name="message"></textarea>
                                </div>
                            </div>
                            <div id="contactus-error" class="alert alert-danger" role="alert" style="display: none;">
                            </div>

                        </div>

                        <div class="d-flex py-4 justify-content-end">
                            <div class="px-1">
                                <button type="button" class="btn btn-outline-secondary px-4" style="border-radius: 23px"
                                    data-dismiss="modal">cancel</button>
                            </div>
                            <input type="hidden" id="user_user_id" name="user_id" value="{{ Auth::user()->user_id }}">

                            <div class="px-1">
                                <button type="submit" class="btn btn-outline effects px-4"
                                    style="border-color: #f88634 ;border-radius: 23px; color: #f88634" id="contactus">Save
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth

</footer>
