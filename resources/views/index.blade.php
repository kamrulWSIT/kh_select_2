<!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 with Select2</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Include Select2 CSS CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<body>



    <div class="container mt-5">
        <select id="mySelect" class="form-select">
        </select>
    </div>




    <!-- Include jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Select2 JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function () {
            $('#mySelect').select2({
                ajax: {
                    url: '{{ route('get.countries') }}',
                    type: 'GET',
                    dataType: 'json',
                    delay: 250, // Reduced delay for better responsiveness
                    data: function (params) {
                        return {
                            term: params.term || '', // Search term
                            page: params.page || 1 // Current page
                        };
                    },
                    processResults: function (data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.paginatedCountries.map(function (item) {
                                return { id: item.code, text: item.name }; // Map to Select2 expected structure
                            }),
                            pagination: {
                                more: params.page < data.last_page // Check if more pages exist
                            }
                        };
                    },
                    cache: true,
                },
                placeholder: 'Select a Country',
                templateResult: function (data) {
                    if (data.loading) {
                        return data.text;
                    }
                    return data.text; // Customize display if needed
                },
            });
        });



    </script>



</body>
</html>
