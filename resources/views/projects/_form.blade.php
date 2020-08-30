@csrf

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="title">Naslov</label>

    <div class="control">
        <input
                type="text"
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full"
                name="title"
                placeholder="Moj novi projekt"
                required
                value="{{ $project->title }}">
    </div>
</div>

<div class="field mb-6">
    <label class="label text-sm mb-2 block" for="description">Opis</label>

    <div class="control">
            <textarea
                name="description"
                rows="10"
                class="textarea bg-transparent border border-grey-light rounded p-2 text-xs w-full"
                placeholder="Začel se bom učiti programiranje."
                required>{{ $project->description }}</textarea>
    </div>
</div>

<div class="field">
    <div class="control">
        <button type="submit" class="is-link mr-2 py-2 px-5" style="background-color: #ed8780; 
        text-decoration: none;
        box-shadow: 0 2px 7px 0 #ed8500; 
        border-radius: 5rem;
        color: white;
        font-size: 0.8rem;">{{ 'Uredi Projekt' }}</button>

        <a style="background-color: #ed8780; 
        text-decoration: none;
        box-shadow: 0 2px 7px 0 #ed8500; 
        border-radius: 5rem;
        color: white;
        font-size: 0.8rem;" class="is-link mr-2 py-2 px-5" href="{{ $project->path() }}">Prekini</a>
    </div>
</div>

@if ($errors->any())
    <div class="field mt-6">
        @foreach ($errors->all() as $error)
            <li class="text-sm text-red">{{ $error }}</li>
        @endforeach
   </div>  {{--  Show errors, pomembno, da dodamo ob vsakemu formu --}}
@endif