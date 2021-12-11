<!DOCTYPE html>
<html>
    <head>
        <title>Data TicketPlease</title>
    </head>
    <body>
        <h2>Data Ticket Event</h2>

        <table border="1">
            <tr>
                <th>Kode Tiket</th>
                <th>Nama Event</th>
                <th>Nama Pemesan</th>
                <th>Section</th>
                <th>Seat Number</th>
                <th>Tanggal Event</th>
                <th>Waktu Event</th>
                <th>Venue Event</th>
                <th>Alamat Event</th>
            </tr>
            @foreach($ticketevent as $t)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
        </table>
    </body>
</html>


