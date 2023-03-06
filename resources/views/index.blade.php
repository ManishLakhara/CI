@extends('layouts.app')
@section('content')

<div class="container border-top border-bottom"> 
    <div action="" class="row">
        <div class="col input-group">
            <div class="div d-flex align-items-center ">
                <div class='d-flex'>
                    <button id="search-button" type="button" class="btn btn-white">
                        <i class="fa fa-search text-muted" aria-hidden="true"></i>
                    </button>
                  <input id="search-input" type="search" id="div1" class="div-control w-100 border-0 py-4" placeholder="Search Mission..."/>
                </div>
            </div>
        </div>
        <div class="col d-flex justify-content-around">
            <div class="border-start input-group px-2">
                <select class="custom-select w-100 border-0 text-muted" >
                    <option selected>Country</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            
            
            <div class="border-start input-group px-2">
                <select class="custom-select w-100 border-0 text-muted" >
                    <option selected>City</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="border-start input-group px-2">
                <select class="custom-select w-100 border-0 text-muted" >
                    <option selected>Theme</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="border-start border-end input-group px-2">
                <select class="custom-select w-100 border-0 text-muted" >
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
    <div class="d-flex py-4 justify-content-between">
        <div>
            <h4> <span class="light-theme-color">Explore</span>  <span class="theme-color">72 Mission</span> </h4>
        </div>
        <div class="d-flex">
            <div class="input-group px-2" style="width: 200px ">
                <select class="custom-select w-100 border-1 text-muted" >
                    <option selected>Sort by</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                 </select>
            </div>
            <div class='d-flex px-3 justify-content-center align-items-center'>
                <input type="radio" class="btn-check" name="view" value='0' id="grid-view">
                <label class="btn p-1 rounded-circle "  for="grid-view"><img src={{asset('Images/grid.png')}} alt=""></label>
                <input type="radio" class="btn-check" name="view" id="list-view">
                <label class="btn p-2 rounded-circle" value='1' for="list-view"><img src={{asset('Images/list.png')}} alt=""></label>
            </div>
        </div>
    </div>

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
                        <fieldset>
                            <legend>
                                This is Awesome
                            </legend>
                        </fieldset>
                            
                        
                          <div class="d-flex py-2 justify-content-between">
                                @if(true)
                                    <div class="d-flex align-items-center ">
                                        <div class="px-1">
                                            <img src={{asset('Images/seats-left.png')}} alt="">
                                        </div>
                                        <div class="px-2 d-flex flex-column align-items-start">
                                            <span class="theme-color fs-5 font-weight-bolder">10 <br></span>
                                            <span class="text-muted">Seats left</span>
                                        </div>
                                    </div>
                              @else
                                <div class="d-flex align-items-center ">
                                    <div class="px-1">
                                        <img src={{asset('Images/Already-volunteered.png')}} alt="">
                                    </div>
                                    <div class="px-2 d-flex flex-column align-items-start">
                                        <span class="theme-color fs-5 font-weight-bolder">250<br></span>
                                        <span class="text-muted"><small>Already volunteered</small></span>
                                    </div>
                                </div>
                              @endif

                              @if(true)
                                <div class='d-flex align-items-center'>
                                    <div class="px-1">
                                        <img src={{asset('Images/deadline.png')}} alt="">
                                    </div>
                                    <div class=" px-2 d-flex flex-column align-items-start">
                                        <span class="theme-color fs-5 font-weight-bolder">09/01/2019 <br></span>
                                        <span class="text-muted">Deadline</span>
                                    </div>
                                </div>
                              @elseif(false)
                                <div class='d-flex align-items-center'>
                                    <div class="px-1">
                                        <img src={{asset('Images/achieved.png')}} alt="">
                                    </div>
                                    <div class=" px-2 d-flex flex-column align-items-start">
                                        <input type="range" class="goal-range" name="goal" value="80" disabled id="achievedgoal">
                                        <span class="text-muted"><small>8000 Achieved</small></span>
                                    </div>
                                </div>
                              @endif
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