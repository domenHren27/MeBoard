
 <div class="bg-white p-5 rounded-lg shadow shadow flex flex-col">
    <h3 class="font-normal text-xl py-5 -ml-5 border-l-4 border-blue-light pl-4 mb-4">
        <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
    </h3>

    <div class="text-grey-dark mb-4 flex-1"> {{ Str::limit($project->description, 100) }} </div>
    
    @can('manage', $project)
        <footer>
            <form method="POST" action="{{ $project->path() }}" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs">Dlete</button>
            </form>
        </footer> 
    @endcan 

</div>


