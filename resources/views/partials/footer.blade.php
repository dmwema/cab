    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/kinzi.print.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script>
        $(document).ready(() => {
            $('#print').click(() => {
                $('table th:last-child').hide();
                $('table td:last-child').hide();

                $('#toprint').kinziPrint({
                        debug: false,
                        importCss: true,
                        loa8081dCss: "{{ asset('/css/print.css') }}",
                })

                window.setTimeout(function () {
                    $('table th:last-child').show();
                    $('table td:last-child').show();
                }, 1)
            })
        })
    </script>
</body>
</html>