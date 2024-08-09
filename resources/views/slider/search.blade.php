<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="container">
        <h6>Serach Images</h6>
        <div class="mb-3">
            <input type="text" id="search-query" class="form-control" placeholder="Search Image">
            <button id="search-button" class="btn btn-primary">Search </button>
            <div id="results" class="mt-3"></div>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#search-button').click(function() {
            const query = $('#search-query').val();
            $.ajax({
                url: '/search',
                method: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    let html = '';
                    if (data.data && Array.isArray(data.data)) {
                        data.data.forEach(image => {
                            html += `<div class="form-check>
                                <input type="checkbox" class="form-check" value="${image.id}"
                                <img src ="${image.assets.preview.url}" width="100" class="img-thumbnail">
                                </div>`;
                        });
                        $('#results').html(html);
                    } else {
                        console.warn('data not found');
                    }
                },

                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
        $('#save-button').on('click', function() {
            const selectedImages = $('input[name="image_urls[]"]:checked').map(function() {
                return $(this).val();
            }).get();
            $.ajax({
                url: "{{ route('save-image') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    image_urls: selectedImages
                },
                success: function(response) {
                    if (response.success) {
                        alert('Images saved successfully!');
                    }
                }
            });
        });
    });
</script>