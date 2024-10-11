@foreach($unpaidConsultations as $consult)
    {{ $consult->consultation_number }} - {{ \Carbon\Carbon::parse($consult->consultation_date)->format('d/m/Y') }}
    - {{ $consult->patient_name }} -
    R$ {{ $consult->reference_price }} <br>
@endforeach
<br><br>
Thanks,<br>
{{ config('app.name') }}
