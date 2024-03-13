$(document).ready(function () {
    $('#editcandidateForm').validate({
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            phoneNumber: {
                required: true,
                maxlength: 10,
                minlength: 10,
            },
            reference: {
                required: true,
            },
            designation: {
                required: true,
            }
        },
        messages: {
            name: 'Please enter candidate name',
            email: {
                required: 'Please enter candidate email',
                email: 'Please enter valid email address',
            },
            phoneNumber: {
                required: 'Please enter mobile number',
                maxlength: "Mobile number must be at least 10 digit only",
                minlength: "Mobile number must be at least 10 digit only",
            },
            reference: {
                required: "Please enter reference",
            }, 
            designation: {
                required: "Please enter position",
            }
        },
    });
    $("#resumeUpload").click(function() {
        $("input[id='resume']").click();
    });
    setTimeout(function () {
        $('.alert-danger').remove();
    }, 3000);
    $('#resume').change(function (e) {
        var ext = $("#resume").val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['doc', 'pdf', 'docx', 'jpg', 'png', 'jpeg', 'rtf']) == -1) {
            alert('Please select valid file');
            $('#resume').val('');
        }
        var file_size = $('#resume')[0].files[0].size;
        if(file_size >= 4000000) {
            alert('File size is greater than 4mb');
            $('#resume').val('');
        }
		if (ext == 'pdf' && file_size >= 1000000) {
            $('#resumeUpload').remove();
            $('.previewFile').after('<div id="canvasPDF" style="max-height:100%;max-width:100%;overflow: scroll;"><canvas id="resumeUpload" height="550px"></canvas></div>');
            // Loaded via <script> tag, create shortcut to access PDF.js exports.
            var pdfjsLib = window['pdfjs-dist/build/pdf'];
            // The workerSrc property shall be specified.
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';
            var file = e.target.files[0]
            if (file.type == "application/pdf") {
                var fileReader = new FileReader();
                fileReader.onload = function () {
                    var pdfData = new Uint8Array(this.result);
                    // Using DocumentInitParameters object to load binary data.
                    var loadingTask = pdfjsLib.getDocument({ data: pdfData });
                    loadingTask.promise.then(function (pdf) {
                        // Fetch the first page
                        var pageNumber = 1;
                        pdf.getPage(pageNumber).then(function (page) {
                            var scale = 2.2;
                            var viewport = page.getViewport({ scale: scale });

                            // Prepare canvas using PDF page dimensions
                            var canvas = $("#resumeUpload")[0];
                            var context = canvas.getContext('2d');
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            // Render PDF page into canvas context
                            var renderContext = {
                                canvasContext: context,
                                viewport: viewport
                            };
                            var renderTask = page.render(renderContext);
                            renderTask.promise.then(function () {
                                
                            });
                        });
                    }, function (reason) {
                        // PDF loading error
                        // console.error(reason);
                    });
                };
                fileReader.readAsArrayBuffer(file);
            }

        } else {
            filePreview(this, ext);
        }
    });
    $('#start_date').datetimepicker({
        format:'Y-m-d H:i',
        scrollInput: false,
    });
    $('#end_date').datetimepicker({
        format:'Y-m-d H:i',
        scrollInput: false,
    });
    $('#join_date').datetimepicker({
        format:'Y-m-d',
        timepicker: false,
        scrollInput: false,
    });
    $('#status').change(function () {
        if ($(this).val() == '1') {
            $('.comment').show();
            $('.t_experience').hide();
            $('.current_ctc').hide();
            $('.expected_ctc').hide();
            $('.notice_peroid').hide();
            $('.start_date').hide();
            $('.end_date').hide();
            $('.type').hide();
            $('.interviewer').hide();
            $('.shortlisted_status').hide();
            $('.feedback_status').hide();
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
            $('.mail').hide();
        } else if ($(this).val() == '2') {
            $('.comment').show();
            $('.t_experience').hide();
            $('.current_ctc').hide();
            $('.expected_ctc').hide();
            $('.notice_peroid').hide();
            $('.start_date').hide();
            $('.end_date').hide();
            $('.type').hide();
            $('.interviewer').hide();
            $('.shortlisted_status').hide();
            $('.feedback_status').hide();
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
            $('.mail').hide();
        } else if ($(this).val() == '3') {
            $('.comment').show();
            $('.t_experience').hide();
            $('.current_ctc').hide();
            $('.expected_ctc').hide();
            $('.notice_peroid').hide();
            $('.start_date').hide();
            $('.end_date').hide();
            $('.type').hide();
            $('.interviewer').hide();
            $('.shortlisted_status').hide();
            $('.feedback_status').hide();
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
            $('.mail').show();
        } else if ($(this).val() == '4') {
            $('.comment').show();
            $('.t_experience').show();
            $('.current_ctc').show();
            $('.expected_ctc').show();
            $('.notice_peroid').show();
            $('.start_date').hide();
            $('.end_date').hide();
            $('.type').hide();
            $('.interviewer').show();
            $('.shortlisted_status').show();
            $('.feedback_status').hide();
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
            $('.mail').show();
        } else if ($(this).val() == '5') {
            $('.comment').show();
            $('.t_experience').show();
            $('.current_ctc').show();
            $('.expected_ctc').show();
            $('.notice_peroid').show();
            $('.start_date').show();
            $('.end_date').show();
            $('.type').show();
            $('.interviewer').show();
            $('.shortlisted_status').hide();
            $('.feedback_status').show();
            $('.candidate_status').show();
            $('.join').show();
            $('.join_date').show();
            $('.mail').show();
        } else if ($(this).val() == '6') {
            $('.comment').show();
            $('.t_experience').hide();
            $('.current_ctc').hide();
            $('.expected_ctc').hide();
            $('.notice_peroid').hide();
            $('.start_date').hide();
            $('.end_date').hide();
            $('.type').hide();
            $('.shortlisted_status').hide();
            $('.interviewer').hide();
            $('.feedback_status').hide();
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
            $('.mail').show();
        } else {
            $('.comment').hide();
            $('.t_experience').hide();
            $('.current_ctc').hide();
            $('.expected_ctc').hide();
            $('.notice_peroid').hide();
            $('.start_date').hide();
            $('.end_date').hide();
            $('.type').hide();
            $('.interviewer').hide();
            $('.shortlisted_status').hide();
            $('.feedback_status').hide();
            $('.candidate_status').hide();
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
            $('.mail').hide();
        }
    });
    $('#feedback_status').change(function(){
        if ($(this).val() == '2') {
            $('.candidate_status').show();
            $('.join').show();
            $('.join_date').show();
        } else {
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
        }
    });
});