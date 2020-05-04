var startDate = moment();
var endDate =  moment();

$(document).ready(function() {
    $('#calendarRange').daterangepicker({
        "showDropdowns": true,
        "showWeekNumbers": true,
        "autoApply": true,
        "autoUpdateInput": false,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'This Year': [moment().startOf('year'), moment()],
        },
        "locale": {
            "format": "DD.MM.YYYY",
            "separator": " - ",
            "applyLabel": "Apply",
            "cancelLabel": "Cancel",
            "fromLabel": "From",
            "toLabel": "To",
            "customRangeLabel": "Custom",
            "weekLabel": "W",
            "daysOfWeek": [
                "Su",
                "Mo",
                "Tu",
                "We",
                "Th",
                "Fr",
                "Sa"
            ],
            "monthNames": [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December"
            ],
            "firstDay": 1
        },
        "alwaysShowCalendars": true,
        "startDate": moment().startOf('year'),
        "endDate": moment()
    }, function(start, end, label) {
         $('#calendarRange').val(start.format('DD.MM.YYYY') + ' - ' + end.format('DD.MM.YYYY'));
        startDate = start;
        endDate = end;
    });

    function fetch_data(page){
        searchTerm = $('#searchInput').val();
        console.log('New date: ' + startDate.format('YYYY-MM-DD 00:00:00') + ' to ' + endDate.format('YYYY-MM-DD 23:59:59') + ' search Ter: ' + searchTerm + '.');

        $.ajax({
            method: "GET",
            url: "filter",
            data: {
                startDate: startDate.format('YYYY-MM-DD 00:00:00'),
                endDate: endDate.format('YYYY-MM-DD 23:59:59'),
                searchTerm: searchTerm,
                page: page,
                entriesPerPage: $('#entriesPerPage').val()
            }
        })
        .done(function( response ) {
            console.log("Data Saved: " + response );

            $('#tableWithPagination').empty();
            $('#tableWithPagination').append(response);
        });
    }

    $( "#refreshBtn" ).click(function() {
        fetch_data(1);
    });

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });
});
