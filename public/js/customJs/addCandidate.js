$(document).ready(function () {
    $('.mail').show();
    $('#addcandidateForm').validate({
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
            },
        }
    });
    $("#resumeUpload").click(function () {
        $("input[id='resume']").click();
    });
    var startDate;
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
        if (file_size >= 4000000) {
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
        format: 'Y-m-d H:i',
        scrollInput: false,
    });
    $('#end_date').datetimepicker({
        format: 'Y-m-d H:i',
        scrollInput: false,
    });
    $('#join_date').datetimepicker({
        format: 'Y-m-d',
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
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
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
            $('.interviewer').hide();
            $('.shortlisted_status').hide();
            $('.feedback_status').hide();
            $('.candidate_status').hide();
            $('.join').hide();
            $('.join_date').hide();
            $('.mail').show();
        } else if ($(this).val() == '0') {
            $('.mail').show();
        }
    });
    $('#feedback_status').change(function () {
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

function mailSend() {
    var name = $('#name').val();
    var designation = $('#designation').val();
    var status = $('#status').val();
    var feedback_status = $('#feedback_status').val();
    if (status == 5 && feedback_status == '') {
        var interview_date = moment($('#start_date').val()).format('Do MMM YYYY');
        var interview_time = moment($('#start_date').val()).format('h:mm A');
        var timeStart = new Date($('#start_date').val());
        var timeEnd = new Date($('#end_date').val());
        var hourDiff = timeEnd - timeStart;
        var diffSeconds = hourDiff / 1000;
        var HH = Math.floor(diffSeconds / 3600);
        var MM = Math.floor(diffSeconds % 3600) / 60;
        var formatted = ((HH < 10) ? ("0" + HH) : HH) + ":" + ((MM < 10) ? ("0" + MM) : MM);
        var content = "Dear " + name + ",%0D%0A%0D%0AAs per our conversation your interview has been Scheduled for the position of " + designation + ". Kindly find the attached details for your reference:%0D%0A%0D%0AInterview on – " + interview_date + "%0D%0A%0D%0AInterview Type –  " + $('#type').val() + "%0D%0A%0D%0AInterview Time – " + interview_time + "%0D%0A%0D%0AInterview Duration – " + formatted + "%0D%0A%0D%0AInterview Venue: 101, Astron Tech Park%0D%0AOpp. Iscon BRTS Bus Stand, Iscon Cross Road,%0D%0AAhmedabad-380015%0D%0A%0D%0ALocation : Ahmedabad(https://lnkd.in/ggidbAE)%0D%0A";
        var subject = 'Interview Schedule for ' + designation + ' (' + name + ' - ' + interview_date + ' ' + interview_time + ')';
        var mail = $('#email').val();
        window.location.href = 'mailto:' + mail + '?subject=' + subject + '&body=' + content;
    } else if (status == 3) {
        var content = "Hello " + name + ",%0D%0A%0D%0AGreetings of the day!!%0D%0A%0D%0AWe are trying to call you for our current job opening of " + designation + ".%0D%0A%0D%0AFor Job description Click here:%0D%0A%0D%0AAbout us:%0D%0A%0D%0ASNDK Corp is a leader in providing IT solutions and support services to small and mid-sized businesses. We are fastest growing IT Company to Cloud and Network Solutions and Software Development, providing digital solutions to multiple clients. SNDK Corp is a company with great ideas and simple goal - Provide best reliable solution to satisfy our customer and build a lifetime relationship with them.%0D%0A%0D%0AOur values are at the heart of our business reputation and are essential to our continued success.%0D%0A%0D%0AWe are focused on Cloud Solutions, Virtualization, Networking and Security. SNDK Corp is professional service dedicated to increase customer service levels while providing best-of-breed solutions. We have a kind of experience that will help you to turn challenges into organization-wide success stories.%0D%0A%0D%0AWhy SNDK Corp:%0D%0A%0D%0AWe are team of highly talented people who work together to achieve higher goals. We are believers. We like challenges.%0D%0A%0D%0ASpecialties:%0D%0AAmazon AWS, Amazon Web Services, Google Cloud Platform, VMware, Cisco Firewall and Routers, IoT, VoIP over Cloud, Networking, SaaS Cloud, Microsoft%0D%0A";
        var subject = 'Job opening for ' + designation + ' at Ahmedabad location';
        var mail = $('#email').val();
        window.location.href = 'mailto:' + mail + '?subject=' + subject + '&body=' + content;
    }
}