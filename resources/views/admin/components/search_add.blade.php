<div class="mt-1 mb-4">
    <div class="row justify-content-between align-items-center">
        <div class="col relative max-w-xs">
            <form action="{{ route($form_action) }}" method="GET">
                @csrf
                <label for="search" class="sr-only">
                    Search
                </label>
                <input type="text" name="s"
                    class="block w-full p-3 pl-10 text-sm border-gray-200 rounded-md focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400"
                    placeholder="Search..." />
            </form>
        </div>
        <div class="col pb-3 p-2 text-md-right">
            <a href="{{ route($add) }}">
                <button type="button" class="btn text-right btn-outline-warning" style="border-radius: 23px">
                    <i class="fa-solid fa-plus px-3"></i> Add</button>
            </a>
        </div>
    </div>
</div>
