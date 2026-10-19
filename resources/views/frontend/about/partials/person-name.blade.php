@php($nameParts = explode(' ', trim($person['name']), 2))
<span class="person-name-part">{{ $nameParts[0] }}</span> <span class="person-name-part">{{ $nameParts[1] ?? '' }}</span>
