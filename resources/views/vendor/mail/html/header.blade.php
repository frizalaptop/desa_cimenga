@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjcrjhnzZiBJVd61_hZ_sEOnSsupAcl8pA5NMWuiotnd34HH3hknHj3FWdl4xLG0oPu78b1R1jIP2QDsjeuvYyeYSNDqHdtZhXi5VcfECABl1gj-4ZK5y7xoofY-rj4O6_CumYEKPkfeJYlI0suwbAFR63NJdBULHQhZlYW77pTYaMcLfmmqOXabg/s320/GKL11_logo-kabupaten-kuningan%20-%20Koleksilogo.com.png') }}" class="logo" alt="Laravel Logo">
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
