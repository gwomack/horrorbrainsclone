<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">

        <input type="rating" x-model="state" />

    </div>
</x-dynamic-component>
