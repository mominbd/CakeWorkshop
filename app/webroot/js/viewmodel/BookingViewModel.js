/**
 * Author: Saman Sedighi Rad
 * Email: saman.sr@gmail.com
 * Date: 24.04.13
 * Time: 00:38
 */
define(['ko', 'jquery', 'block-ui'], function (ko, $) {
    "use strict";

    $(document).ajaxStop($.unblockUI);

    function BookingViewModel() {
        var self = this;

        this.categories = ko.observableArray([]);
        this.saveBooking = ko.observable('Auswahl bestätigen');
        this.working = ko.observable(false);

        this.confirm = function (data, event) {
            var $selected = $('#course tr.selected');

            if ($selected.length === 0) {
                $('#invalid').modal('show');
            } else {
                var $confirm = $('#confirm'),
                    html = '';

                $selected.each(function () {
                    var name = $(this).closest('tr').find('td.course-name').html();
                    html += '<li>' + name + '</li>';
                });
                $confirm.find('.modal-body ol').html(html);
                $confirm.modal('show');
            }
        };

        this.select = function (data, event) {
            $(event.target).closest('tr').toggleClass('info selected');
        };

        this.unsubscribe = function (data, event) {
            $.blockUI({ message: 'Nehme Abmeldung vor...' });

            var id = +$(event.target).closest('tr').data('id');

            $.post(CAKEWORKSHOP.webroot + 'bookings/delete.json', {CoursesTerm: { id: id}})
                .success(function (response) {
                    // Update data
                    self.fetch();
                    alert(response.message);
                })
                .error(function (response) {
                    alert($.parseJSON(response.responseText).name);
                });
        };

        this.fetch = function () {
            $.blockUI({ message: 'Lade, bitte warten...' });

            $.getJSON(CAKEWORKSHOP.webroot + 'bookings/index.json')
                .success(function (data) {
                    self.categories.removeAll();
                    var categories = data.coursesByCategory,
                        i;

                    for (i = 0; i < categories.length; i += 1) {
                        self.categories.push(categories[i]);
                    }
                    // Highlight first button
                    if (categories.length > 0) {
                        setTimeout(function () {
                            $('#address').find('.btn-group button').first().addClass('active');
                        }, 0);
                    }
                })
                .error(function (response) {
                    alert($.parseJSON(response.responseText).name);
                });
        };

        this.save = function () {
            var originalCaption = this.saveBooking(),
                addressId = +$('#address_id').val();

            if (isNaN(addressId)) {
                alert('Keine gültige Rechnung ausgewählt');
                return;
            }

            $.blockUI({ message: 'Nehme Anmeldung vor...' });
            this.saveBooking('Speichere, bitte warten...');

            // Search all selected course ids
            var ids = [];
            var $ids = $('#course tr.selected');

            $ids.each(function () {
                ids.push(parseInt($(this).data('id'), 10));
            });

            $.post(CAKEWORKSHOP.webroot + 'bookings/add.json', {CoursesTerm: ids, Address: {id: addressId}})
                .success(function (response) {
                    // Update data
                    self.fetch();

                    $('#confirm').modal('hide');
                    self.saveBooking(originalCaption);
                    alert(response.message);
                })
                .error(function (response) {
                    self.saveBooking(originalCaption);
                    alert($.parseJSON(response.responseText).name);
                });
        };

        this.fetch();
    }

    return BookingViewModel;
});
