@extends('layouts.app')
@section('content')

<div class="container border-top border-bottom align-content-center">
    <form action="" class="d-flex">
        <div class="input-group">
            <div class="form d-flex align-content-center ">
                <div class='d-flex'>
                    <button id="search-button" type="button" class="btn btn-white">
                        <i class="fa fa-search text-muted" aria-hidden="true"></i>
                    </button>
                  <input id="search-input" type="search" id="form1" class="form-control border-0 py-4" placeholder="Search Mission..."/>
                </div>
            </div>
        </div>
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
    </form>    
</div>
<div class=" container  py-3">
    <div class="row">
        <div class="col-md-3">
            <span class="fs-2 text-start"> Explore <strong>72 Missions</strong></span>
        </div>
        <div class="col">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <button class="btn border-1 btn-lg px-4"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: grey; border-color: grey">Sort by &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src={{asset('Images/drop-down.png')}} alt=""> </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">start date</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Separated link</a>
                          </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn border-1 rounded-circle"><img src={{asset('Images/grid.png')}} alt=""></button>
                    </div>
                    <div class="col-md-1">
                        <button class="btn border-1 rounded-circle"><img src={{asset('Images/list.png')}} alt=""></button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    

        

    
</div>

      













@endsection