@extends('layouts.app')
@section('content')

{{-- <div class="container border-bottom ">
    <div class="row align-content-center">
        <div class="col-md-6">
            <div class="input-group">
                <div class="div d-flex align-content-center ">
                    <div class='d-flex'>
                        <button id="search-button" type="button" class="btn btn-white">
                            <i class="fa fa-search text-muted" aria-hidden="true"></i>
                        </button>
                      <input id="search-input" type="search" id="div1" class="div-control border-0 py-4" placeholder="Search Mission..."/>
                    </div>
                </div>
            </div> 
        </div>
        <div class="col-md-6 ">
            <div class="d-flex">
                <div class="input-group">
                    <select class="custom-select border-0 border-left-1 text-muted" >
                        <option selected>Country</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="input-group">
                    <select class="custom-select border-0 border-left-1 text-muted" >
                        <option selected>City</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="input-group">
                    <select class="custom-select border-0 border-left-1 text-muted" >
                        <option selected>Theme</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="input-group">
                    <select class="custom-select border-0 text-muted" >
                        <option selected>Skill</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                     </select>
                </div>               
            </div>
        </div>
    </div>
</div> --}}

<div class="container border-top border-bottom">
    <div action="" class="d-flex">
        <div class="input-group">
            <div class="div d-flex align-content-center ">
                <div class='d-flex'>
                    <button id="search-button" type="button" class="btn btn-white">
                        <i class="fa fa-search text-muted" aria-hidden="true"></i>
                    </button>
                  <input id="search-input" type="search" id="div1" class="div-control w-100 border-0 py-4" placeholder="Search Mission..."/>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="input-group">
                <select class="custom-select border-0 text-muted" >
                    <option selected>Country</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            
            
            <div class="input-group">
                <select class="custom-select border-0 border-left-1 text-muted" >
                    <option selected>City</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="input-group">
                <select class="custom-select border-0 border-left-1 text-muted" >
                    <option selected>Theme</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="input-group">
                <select class="custom-select border-0 text-muted" >
                    <option selected>Skill</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                 </select>
            </div>
        </div>
    </div>    
</div>

<div class=" container  py-3">
    {{-- <div class="row">
        <div class="col-md-3">
            <span class="fs-2 text-start"> Explore <strong>72 Missions</strong></span>
        </div>
        <div class="col">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col auto-width">
                        <button class="btn border-1"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: grey; border-color: grey">Sort by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src={{asset('Images/drop-down.png')}} alt=""> </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">start date</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                          </div>
                    </div>
                    <div class="col auto-width">
                        <button class="btn rounded-circle"><img src={{asset('Images/grid.png')}} alt=""></button>
                    </div>
                    <div class="col auto-width">
                        <button class="btn rounded-circle"><img src={{asset('Images/list.png')}} alt=""></button>
                    </div>
                </div>
            </div>
            
        </div>
    </div> --}}

    <div class="row py-3">
        @for ($i = 0; $i < 9; $i++)
            <div class="card col-lg-4 col-md-6 border-0  pb-4 text-center">
                    <img class="card-img-top" src={{asset('Images/Grow-Trees-On-the-path-to-environment-sustainability-3.png')}} alt="">
                <div class="card-body">
                  <h4 class='mission-title theme-color pt-3'>Grow tree - On the path to environment sustainability</h4>
                  <p class='card-text mission-short-description'>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Modi repudiandae ratione,
                      eum eos assumenda magni, nihil corporis blanditiis quis deserunt ipsam iste at dicta. Cumque asperiores culpa consequuntur quibusdam ducimus.
                  </p>
                  <div class="d-flex justify-content-between">
                      <div>
                          <span class="theme-color">
                              Tree Canada 
                          </span>
                      </div>
                      <div class="small-ratings">
                          <i class="fa fa-star rating-color"></i>
                          <i class="fa fa-star rating-color"></i>
                          <i class="fa fa-star rating-color"></i>
                          <i class="fa fa-star"></i>
                          <i class="fa fa-star"></i>
                      </div>
                  </div>
                  <div class="py-3">
                      <div class="border-1 border-top border-bottom ">
                          <div class="d-flex py-2 justify-content-between">
                              <div class="d-flex align-items-center ">
                                  <div class="px-1">
                                      <img src={{asset('Images/seats-left.png')}} alt="">
                                  </div>
                                  <div class="d-flex px-2 flex-column align-items-start">
                                      <span class="theme-color fs-5 font-weight-bolder">10 <br></span>
                                      <span class="text-muted">Seats left</span>
                                  </div>
                              </div>
                              <div class='d-flex align-items-center'>
                                  <div class="px-1">
                                      <img src={{asset('Images/deadline.png')}} alt="">
                                  </div>
                                  <div class="d-flex px-2 flex-column align-items-start">
                                      <span class="theme-color fs-5 font-weight-bolder">09/01/2019 <br></span>
                                      <span class="text-muted">Deadline</span>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-lg fs-5 apply-btn"> Apply <i class="fa-sharp fa-solid fa-arrow-right"></i> </button>
                    </div>
                </div>
            </div>
        @endfor

    </div> {{--row-end--}}  
     
</div>
@endsection