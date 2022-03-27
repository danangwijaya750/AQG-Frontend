<style>
    table {
    border-collapse: collapse;
}
</style>
<h3> Judul Soal: {{ $data['quiz']['title'] }}</h3>
<h3> Mata Pelajaran: {{ $data['quiz']['lesson']['title'] }}</h3>
<h3> Tingkat Pendidikan: {{ $data['quiz']['lesson']['level']['title'] }}</h3>

<br>
<b>Soal</b>
@foreach (json_decode($data['quiz']['questions'],true) as  $question)
<br>
<p>Klasifikasi: {{ $question['name'] }} </p>
@foreach ($question['q'] as $q)
<p>
    {{ $loop->iteration }}.     {{ $q }}
</p>
@endforeach

@endforeach


