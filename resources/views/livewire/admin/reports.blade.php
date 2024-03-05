<div>
    <table class="table table-bordered" class="display nowrap">
        <thead>
            <tr>
                <th></th>
                <th colspan="2">{{ $current_month }}</th>
                <th>{{ $last_month }}</th>
                <th>YTD</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Number of houses sold</td>
                <td colspan="2">{{ $house_sold }}</td>
                <td>{{ $house_sold }}</td>
                <td>{{ $house_sold }}</td>
            </tr>
            <tr>
                <td>Number of houses sold No Buyers Agent</td>
                <td colspan="2">{{ $no_agent }}</td>
                <td>{{ $no_agent }}</td>
                <td>{{ $no_agent }}</td>
            </tr>
            <tr>
                <td>Dollar volume of sales</td>
                <td colspan="2">{{ $dollar_sales }}</td>
                <td>{{ $dollar_sales }}</td>
                <td>{{ $dollar_sales }}</td>
            </tr>
            <tr>
                <td>Average transaction $</td>
                <td colspan="2">{{ $avg_transaction }}</td>
                <td>{{ $avg_transaction }}</td>
                <td>{{ $avg_transaction }}</td>
            </tr>
            <tr>
                <td>Commission Generated</td>
                <td colspan="2">{{ $commission }}</td>
                <td>{{ $commission }}</td>
                <td>{{ $commission }}</td>
            </tr>
            <tr>
                <td>Buyer Sales commission</td>
                <td colspan="2">{{ $buyer_commission }}</td>
                <td>{{ $buyer_commission }}</td>
                <td>{{ $buyer_commission }}</td>
            </tr>
            <tr>
                <td>Qonection commission</td>
                <td colspan="2">{{ $qonection_commission }}</td>
                <td>{{ $qonection_commission }}</td>
                <td>{{ $qonection_commission }}</td>
            </tr>
            <tr>
                <td>Average commission</td>
                <td colspan="2">{{ $avg_commission }}</td>
                <td>{{ $avg_commission }}</td>
                <td>{{ $avg_commission }}</td>
            </tr>
            <tr>
                <td>Average Buyer's commission</td>
                <td colspan="2">{{ $avg_buyer_commission }}</td>
                <td>{{ $avg_buyer_commission }}</td>
                <td>{{ $avg_buyer_commission }}</td>
            </tr>
            <tr>
                <td>Buyer's commission savings (2.50%)</td>
                <td colspan="2">{{ $buyer_commission_savings }}</td>
                <td>{{ $buyer_commission_savings }}</td>
                <td>{{ $buyer_commission_savings }}</td>
            </tr>
        </tbody>
    </table>
</div>
