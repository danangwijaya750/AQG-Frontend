<style>
    table {
    border-collapse: collapse;
}
</style>
<h3> Judul Materi: {{ $data['study']['title'] }}</h3>
<h3> Mata Pelajaran: {{ $data['study']['lesson']['title'] }}</h3>
<h3> Tingkat Pendidikan: {{ $data['study']['lesson']['level']['title'] }}</h3>

<br>
<b>Materi</b>
<br>
<p>
    {{ strip_tags($data['study']['desc']) }}
</p>



