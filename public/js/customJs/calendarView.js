var fileData = [];
$(document).ready(function () {
    $(".dropzone").change(function () {
        readFile(this);
    });
    $('.dropzone-wrapper').on('dragover', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).addClass('dragover');
    });
    $('.dropzone-wrapper').on('dragleave', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).removeClass('dragover');
    });
    $('#eventfilter').change(function () {
        loadCalendar();
    });

    $("body").delegate(".newfileName", "click", function () {
        var fileId = $(this).attr('id');
        fileData.splice(fileId, 1);
        $('#fileObject' + fileId).remove();
        $('.fileObject').remove();
        var htmlPreview = '';
        $.each(fileData, function (i, file) {
            htmlPreview = '<p class="fileObject" id="fileObject' + i + '">' + file.name + '<i class="fa fa-times-circle newfileName" id="' + i + '"></i></p>';
            $('.uploadedFile').append(htmlPreview);
        });
    });
    
    $('.fullDay').change(function () {
        if (this.checked) {
            $('.start_date').attr('disabled', 'true');
            $('.start_date').hide();
            $('.end_date').attr('disabled', 'true');
            $('.end_date').hide();
            $('.fullday_start_date').removeAttr('disabled');
            $('.fullday_start_date').show();
            $('.fullday_end_date').removeAttr('disabled');
            $('.fullday_end_date').show();
        } else {
            $('.start_date').removeAttr('disabled');
            $('.start_date').show();
            $('.end_date').removeAttr('disabled');
            $('.end_date').show();
            $('.fullday_start_date').attr('disabled', 'true');
            $('.fullday_end_date').attr('disabled', 'true');
            $('.fullday_start_date').hide();
            $('.fullday_end_date').hide();
        }
    });
    $('.start_date').datetimepicker({
        format: 'Y-m-d H:i',
        scrollInput: false,
    });
    $('.end_date').datetimepicker({
        format: 'Y-m-d H:i',
        scrollInput: false,
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#start_date').val() ? jQuery('#start_date').val() : false
            })
        },
    });
    $('.fullday_start_date').datetimepicker({
        format: 'Y-m-d',
        timepicker: false,
        scrollInput: false,
    });
    $('.fullday_end_date').datetimepicker({
        format: 'Y-m-d',
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#fullday_start_date').val() ? jQuery('#fullday_start_date').val() : false
            })
        },
        timepicker: false,
        scrollInput: false,
    });
    $('body').on('click', function (event) {
        if (!$(event.target).is('.fc-content')) {
            $(".fc-day-grid-event").css("opacity", "1");
        }
    });
});

function readFile(input) {
    var htmlPreview = '';
    $('.noFound').remove();
    $.each(input.files, function (i, file) {
        htmlPreview = '<p class="fileObject" id="fileObject' + i + '">' + file.name + '<i class="fa fa-times-circle newfileName" id="' + i + '"></i></p>';
        $('.uploadedFile').append(htmlPreview);
        fileData.push(file);
    });
}
function allowDrop(event, info) {
    event.preventDefault();
    $('span.fc-day-number').removeClass('dropFile');
    $(info).find('span.fc-day-number').addClass('dropFile');
}
function drop(event, info) {
    event.preventDefault();
    var start_date = $(info).data('date');
    start_date = moment(start_date).format('YYYY-MM-DD HH:mm');
    readFile(event.dataTransfer);
    $("#myModal").modal("show");
    $('.start_date').val(start_date);
}
function nodrop(event, info) {
    event.preventDefault();
    event.dataTransfer.dropEffect = "none";
}
function noallowDrop(event) {
    event.preventDefault();
    event.dataTransfer.dropEffect = "none";
}
function dragLeave(event) {
    $('span.fc-day-number').removeClass('dropFile');
}

function calendarClass() {
    $('.fc-toolbar.fc-header-toolbar').addClass('oldcalendar');
    $('.fc-view-container').addClass('oldcalendar');
    $('.fc-day').attr('ondrop', 'drop(event, this)');
    $('.fc-day-top').attr('ondrop', 'drop(event, this)');
    $('.fc-day').attr('ondragover', 'allowDrop(event, this)');
    $('.fc-day-top').attr('ondragover', 'allowDrop(event, this)');
    $('.fc-day-top').attr('ondragleave', 'dragLeave(event)');
    $('.fc-content-skeleton tbody td').attr('ondragover', 'noallowDrop(event)');
    $('.fc-content-skeleton tbody td').attr('ondrop', 'nodrop(event, this)');
    $('.fc-today span.fc-day-number').addClass('currentDate');
    $('div.fc-content').after('<div class="fc-resizer fc-end-resizer"></div>');
}

function editeventDetails(response, info) {
    $('.eventHeading').html('Edit Event');
    $('#editEvent').val(info.event.id);
    $('.delete-user').attr('id', info.event.id);
    $('.delete-user').show();
    $('#btnSaveIt').html('Update');
    $('.noFound').remove();
    if (response.fullday == 1) {
        $('.start_date').attr('disabled', 'true');
        $('.start_date').hide();
        $('.end_date').attr('disabled', 'true');
        $('.end_date').hide();
        $('.fullday_start_date').removeAttr('disabled');
        $('.fullday_start_date').show();
        $('.fullday_end_date').removeAttr('disabled');
        $('.fullday_end_date').show();
        var eventstartDate = moment(response.start_date).format('YYYY-MM-DD');
        var eventendDate = moment(response.end_date).format('YYYY-MM-DD');
        if (response.end_date == null) {
            eventendDate = '';
        }
        $('.fullday_start_date').val(eventstartDate);
        $('.fullday_end_date').val(eventendDate);
        $(".fullDay").prop("checked", true);
    } else {
        var eventstartDate = moment(response.start_date).format('YYYY-MM-DD HH:mm');
        var eventendDate = moment(response.end_date).format('YYYY-MM-DD HH:mm');
        if (response.end_date == null) {
            eventendDate = '';
        }
        $('.start_date').removeAttr('disabled');
        $('.start_date').show();
        $('.end_date').removeAttr('disabled');
        $('.end_date').show();
        $('.fullday_start_date').attr('disabled', 'true');
        $('.fullday_end_date').attr('disabled', 'true');
        $('.fullday_start_date').hide();
        $('.fullday_end_date').hide();
        $('.start_date').val(eventstartDate);
        if (response.end_date == '0000-00-00 00:00:00') {
            $('.end_date').val('');
        } else {
            $('.end_date').val(eventendDate);
        }
        $(".fullDay").prop("checked", false);
    }
    var fileName = '';
    if (jQuery.isEmptyObject(response.event_file)) {
        fileName = '<p class="noFound" id="noFound">No attachment found.</p>';
        $('.uploadedFile').append(fileName);
    }
    $.each(response.event_file, function (i, name) {
        var originalName = name.file.split("+");
        fileName = '<p class="editFile" id="editFile' + name.id + '">' + originalName[0] + originalName[2] + '<i class="fa fa-times-circle editfileName" id="' + name.id + '"></i></p>';
        $('.uploadedFile').append(fileName);
    });
    $('#comment').val(response.comment);
    $('#assign_by').val('');
    $(".timezone").val('').trigger("change");
    $('.timezone').val(response.timezone_value).trigger('change');
    $('#assign_by').val(response.creater_by);
    $("#assign").val(null).trigger("change");
    $('#assign').val(response.assign).trigger('change');
    $("#myModal").modal("show");
}