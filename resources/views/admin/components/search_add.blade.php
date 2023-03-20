<div class="mt-4 mb-4">
    <div class="row justify-content-between align-items-center">
        <div class="col-sm-4 relative w-100">
            <form action="{{ route($form_action) }}" method="GET">
                @csrf
                <label for="search" class="sr-only">
                    Search
                </label>
                <div class="d-flex border rounded w-100">
                    <button type="submit" class="btn">
                        <i class="fas fa-search"></i>
                      </button>
                    <div class="form-outline w-100">
                      <input type="search" name="s" placeholder="Search" value='{{request()->input('s')}}' class="form-control border-0" />
                    </div>
                </div>    
            </form>
        </div>
        <div class="col-sm-4 pb-3 p-2  text-right">
            <a href="{{ route($add)}}">
                <button type="button" class="btn text-right" style="border-radius: 23px; border-color: #F88634; color: #F88634;">
                    <i class="fa-solid fa-plus"></i> Add</button>
            </a>
        </div>
    </div>
</div>
