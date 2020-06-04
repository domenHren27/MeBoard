
<div class="bg-white p-5 rounded-lg shadow shadow" style="height: 200px;">
    <h3 class="font-normal text-xl py-5 -ml-5 border-l-4 border-blue-light pl-4 mb-4">
        <a href="{{ $project->path() }}" class="text-black no-underline">{{ $project->title }}</a>
    </h3>

    <div class="text-grey-dark"> {{ Str::limit($project->description, 100) }} </div>
</div> 

