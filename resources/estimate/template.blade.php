<!-- Buttons to select templates -->



<div class="col-lg-8 col-12 ">
    <button class="btn btn-primary" id="IT_gernal" type="button">IT General</button>
<button class="btn btn-primary" id="software" type="button">Software</button>
<button class="btn btn-primary" id="web_development" type="button">Web Development</button>


<br>
<br>


<textarea class="form-control editme" rows="50" cols="50" name="CustomerNotes" id="notes" placeholder=""></textarea>

        

   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ URL('/assets/js/tinymce.min.js') }}"></script>
    <script>
        tinymce.init({
            selector: "#notes",
            height: 800,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ]
        });

        $(document).ready(function() {
            
           
            $('#IT_gernal').click(function() {
                var newContent = `<b>Scope of Work:</b>
                    <ol>
                        <li>Supply and installation of 4 MP Hikvision.</li>
                    </ol>
                    <b>Exclusion:</b>
                    <ol>
                        <li>Any approval or NOC from any Local Authorities or Government.</li>
                        <li>Any extra items not mentioned in the contract (Cable termination, civil works).</li>
                    </ol>
                    <b>Terms & Conditions:</b>
                    <ol>
                        <li>Amount in AED:
                            <ul>
                                <li>50% Advance (Non-Refundable).</li>
                                <li>30% upon Materials Delivery.</li>
                                <li>20% upon Completion.</li>
                            </ul>
                        </li>
                        <li>Quotation valid for 20 days from date of submission.</li>
                        <li>Any additional work which is not mentioned in this quote will be charged as a variation.</li>
                        <li>All active devices supplied by EIS are subject to a One-year Warranty for any hardware defects. Physical damage is not covered under warranty (water damage as well).</li>
                        <li>Any damage caused to hardware by electric shutdown or excess voltage is not covered under warranty.</li>
                    </ol>`;
                tinymce.get('notes').setContent(newContent);
            });

            $('#software').click(function() {
                var newContent = ` <b>Scope of Work</b>
                   
                    <ul>
                        <li>Cloud-based POS software will be provided for the restaurant.</li>
                        <li>Training will be provided.</li>
                        <li>Installation of software for the restaurant.</li>
                    </ul>

                    <b>Terms & Conditions</b>
                    <ul>
                        <li>Payment: 100% upon agreement.</li>
                        <li>Quotation valid for limited time.</li>
                        <li>POS machine has 2 years warranty, printer and barcode scanner has 1 year warranty each.</li>
                        <li>Any additional work or item which is not mentioned in this quote, will be charged as variation.</li>
                    </ul>`;
                tinymce.get('notes').setContent(newContent);
            });

            $('#web_development').click(function() {
                var newContent = ` 
                <b>Terms & Conditions:</b>
                <ul>
                    <li>Payment: 50% in advance, 50% upon completion</li>
                    <li>Any additional work or item which is not mentioned in this quote will be charged as variation.</li>
                    <li>Unlimited storage and user.</li>
                </ul>

                <p><strong>Above quotation approved</strong></p>`;
                tinymce.get('notes').setContent(newContent);
            });

           
        });
    </script>
    <div class="mt-2"><button type="submit"
            class="btn btn-success w-md float-right">Save</button>
        <a href="{{ URL('/Estimate') }}"
            class="btn btn-secondary w-md float-right">Cancel</a>

    </div>







</div>