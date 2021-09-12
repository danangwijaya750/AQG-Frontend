<!DOCTYPE html>
<html>
<body>

@if ($quiz->type === 1)
Pilihan Ganda
@elseif($quiz->type === 2)
Isian Singkat
@endif
<br>
<ol>
    @foreach ($question as $d)
    <li>
        {{ $d->question }}
    </li>
    @endforeach
</ol>
</body>


</html>
