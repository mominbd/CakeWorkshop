<div class="page-header">
    <h3><?php echo __('Kursverwaltung'); ?></h3>
</div>

<div class="tabbable" ng-app>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#current" data-toggle="tab"><?php echo __('Aktuelle Kurse'); ?></a></li>
        <li><a href="#past" data-toggle="tab"><?php echo __('Bereits besuchte Kurse'); ?></a></li>
    </ul>

    <div class="tab-content">

        <div class="tab-pane active" id="current" ng-controller="BookingsController">

            <div class="alert bg-light-blue">
                <button data-dismiss="alert" class="close" type="button">×</button>
                <p>
                    <strong>Hinweis zur Anmeldung bei ausgebuchten Kursen:</strong> Falls Kurse ausgebucht sind, dann melden Sie sich bitte trotzdem an. Oft werden noch Plätze über die Warteliste frei bzw. bei großem Interesse bieten wir auch Wiederholungstermine für einzelne Kurse an (gelb markierte Zeilen).
                    <hr />
                    Bitte wählen Sie zuerst die Kurse die Sie belegen möchten aus und bestätigen Sie Ihre Auswahl am unteren Ende der Seite. Sie bekommen eine Email mit einer vorläufigen bestätigung Ihrer Anmeldung. Die Zusage für Ihre Anmeldung erhalten Sie nochmal separat, sofern Sie zu dem Kurs zugelassen wurden. Sie können sich <strong>hier</strong> auch selbständig von Kursen abmelden innerhalb einer Frist von 2 Wochen vor dem Kurs.
                </p>
            </div>

            <div id="invoice">
                <form class="form-inline" data-bind="visible: showInvoiceControls">
                    <label>Bitte wählen Sie einer Ihrer bestehende Rechnungsadresse oder erstellen Sie eine neue:</label><br />
                    <div class="btn-group" data-toggle="buttons-radio" data-bind="click: load, foreach: invoices">
                        <button data-bind="attr: { 'data-id': id }, text: name + '-' + ($index() + 1)" type="button" class="btn btn-small"></button>
                    </div>
                    <button type="button" class="btn btn-small" data-bind="click: add, disable: working">Neue Rechnungsvorlage anlegen</button>
                </form>

                <form class="well form-horizontal" data-bind="visible: show, submit: save">
                    <fieldset>
                        <legend><?php echo __('Rechnungsadresse'); ?></legend>

                        <input id="invoice_id" type="hidden" data-bind="value: invoice_id" value=""/>

                        <div class="control-group">
                            <label class="control-label">Rechnung An</label>
                            <div class="controls">
                                <select class="span2" data-bind="
                                        disable: working,
                                        options: types,
                                        optionsText: 'name',
                                        optionsValue: 'value',
                                        value: type_name,
                                        event: { change: toggleType }">
                                </select>
                            </div>
                        </div>

                        <div class="control-group" data-bind="visible: business">
                            <label class="control-label">Institution</label>
                            <div class="controls">
                                <input type="text" class="span3" data-bind="disable: working,value: institution"/>
                            </div>
                        </div>

                        <div class="control-group" data-bind="visible: business">
                            <label class="control-label">Abteilung</label>
                            <div class="controls">
                                <input type="text" class="span3" data-bind="disable: working,value: department"/>
                            </div>
                        </div>

                        <div class="control-group" data-bind="visible: business">
                            <label class="control-label">Hauspostfach</label>
                            <div class="controls">
                                <input type="text" class="span3" data-bind="disable: working,value: postbox"/>
                            </div>
                        </div>

                        <div class="control-group" data-bind="visible: business">
                            <label class="control-label">Zu Händen</label>
                            <div class="controls">
                                <input type="text" class="span3" data-bind="disable: working,value: to_person"/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Straße</label>
                            <div class="controls">
                                <input type="text" class="span3" data-bind="disable: working,value: street" required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">PLZ</label>
                            <div class="controls">
                                <input type="number" maxlength="5" class="span1" data-bind="disable: working,value: zip" required/>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Ort</label>
                            <div class="controls">
                                <input type="text" class="span3" data-bind="disable: working,value: location" required/>
                            </div>
                        </div>
                        <hr/>

                        <div class="control-group">
                            <button type="submit" data-bind="disable: working, text: saveCaption" class="btn btn-primary"><?php echo __('Speichern'); ?></button>
                            <button type="button" data-bind="click: destroy, disable: working, visible: loaded" class="btn btn-danger"><?php echo __('Löschen'); ?></button>
                            <!--<button type="button" data-bind="click: cancel, disable: working" class="btn">Abbrechen</button>-->
                        </div>
                    </fieldset>
                </form>
            </div>

            <div id="course">
                <form id="formBooking" data-bind="submit: confirm">
                    <div data-bind="foreach: { data: categories, as: 'category' }">
                        <h4 data-bind="text: category.Category.name"></h4>
                        <table class="table-courses table table-bordered table-condensed table-striped table-hover">
                            <thead>
                            <tr>
                                <th rowspan="2" width="5%">Kurs-Nr.</th>
                                <th rowspan="2" width="50%">Kurs-Titel</th>
                                <th rowspan="2" width="15%">Semester</th>
                                <th colspan="3">Verantstaltungstag(e)</th>
                                <th rowspan="2" width="5%">Aktuelle Belegung</th>
                                <th rowspan="2" width="5%">Maximale Teilnehmer</th>
                                <th rowspan="2" width="5%" data-bind="if: category.Category.isEditable">Auswahl</th>
                            </tr>
                            <tr>
                                <th>Am</th>
                                <th>Von</th>
                                <th>Bis</th>
                            </tr>
                            </thead>

                            <tbody data-bind="foreach: { data: category.Category.CoursesTerm, as: 'CoursesTerm' }">
                                <tr data-bind="visible: category.Category.isEmpty">
                                    <td colspan="8">Momentan stehen keine Kurse zur Auswahl</td>
                                </tr>
                                <tr data-bind="
                                    attr: {
                                        'data-id': CoursesTerm.id, 'data-status': CoursesTerm.booking_state,
                                        'class': 'choice ' + CoursesTerm.errorClass + ' ' + CoursesTerm.lockedClass + ' ' + CoursesTerm.confirmedClass
                                    }">
                                    <td class="course-id" data-bind="text: CoursesTerm.id"></td>
                                    <td data-bind="text: CoursesTerm.Course.name" class="course-name"></td>
                                    <td data-bind="text: CoursesTerm.Term.name"></td>
                                    <!-- days -->
                                    <td colspan="3" style="min-width: 230px;">
                                        <span data-bind="if: CoursesTerm.noDays">Noch kein Termin festgelegt</span>
                                        <div data-bind="foreach: { data: CoursesTerm.days, as: 'day' }">
                                            <span data-bind="text: day.start_date + ', ' + day.start_time + ' Uhr, ' + day.end_time + ' Uhr'"></span>
                                            <br/>
                                        </div>
                                    </td>
                                    <!-- end days -->
                                    <td class="table-center" data-bind="text: CoursesTerm.attendees"></td>
                                    <td class="table-center" data-bind="text: CoursesTerm.max"></td>
                                    <td class="check" data-bind="visible: CoursesTerm.isEditable">
                                        <a data-bind="visible: CoursesTerm.Booking.allowSubscribe, click: $root.select" class="btn btn-primary btn-mini" data-toggle="button">Auswählen</a>
                                        <a data-bind="visible: CoursesTerm.Booking.allowUnsubscribe, click: $root.unsubscribe" class="btn btn-mini btn-warning">Abmelden</a>
                                        <span data-bind="visible: CoursesTerm.Booking.adminUnsubscribed" class="label label-important">Abgemeldet</span>
                                        <span data-bind="visible: CoursesTerm.locked" class="label label-important bg-orange">Gesperrt</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Ausgewählte Kurse Belegen</button>
                    </div>
                </form>

                <div id="confirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                     aria-hidden="true">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h3><?php echo __('Ihre gewählten Kurse'); ?></h3>
                        <small><?php echo __('Bitte Überprüfen Sie Ihre Ihre Auswahl vor der Belegung'); ?></small>
                    </div>

                    <div class="modal-body">
                        <ol></ol>

                        <hr/>
                        <p class="text-info"><?php echo __('Sie erhalten eine Bestätigung per Email mit einer Übersicht Ihrer gebuchten Kurse'); ?></p>
                    </div>

                    <div class="modal-footer">
                        <button data-bind="click: save, text: saveBooking, disable: working" autocomplete="off" type="button" class="btn btn-primary"></button>
                        <button class="btn" data-bind="disable: working" data-dismiss="modal" aria-hidden="true"><?php echo __('Abbrechen'); ?></button>
                    </div>
                </div>
            </div>

            <div id="invalid" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3><?php echo __('Ungültige Auswahl'); ?></h3>
                </div>
                <div class="modal-body">
                    <p><?php echo __('Sie haben keinen Kurs ausgewählt, wählen Sie bitte mindestens einen.'); ?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true"><?php echo __('Ok'); ?></button>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="invoices">
        </div>

    </div>
</div>

<?php echo $this->Html->script('bookings/index'); ?>