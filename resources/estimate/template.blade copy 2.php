<!-- Buttons to select templates -->



<div class="col-lg-8 col-12 ">
    <button class="btn btn-primary" id="cctvBtn" type="button">CCTV</button>
<button class="btn btn-primary" id="posBtn" type="button">POS</button>
<button class="btn btn-primary" id="template3Btn" type="button">Template 3</button>
<button class="btn btn-primary" id="template4Btn" type="button">Template 4</button>

    <textarea class="form-control editme" rows='50' cols="50" name="CustomerNotes" id="notes" placeholder="">
        <b>Scope of Work:</b>
        <ol>
            <li>Supply and installation of 4 MP Hikvision.</li>
        </ol>


        <b>Exclusion:</b>
        <ol>
            <li>Any approval or NOC from any Local Authorities or Government.</li>
            <li>Any extra items not mentioned in the contract (Cable termination, civil works).</li>
        </ol>



        <b>Terms & Conditions</b>
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
        </ol>
    </textarea>

    <textarea name="x" id="x" cols="30" class="kashif" rows="10">
        test
    </textarea>
        

   
    <script src="{{ URL('/assets/js/tinymce.min.js') }}"></script>
    <script id="rendered-js">
        tinymce.init({
            selector: "textarea:not(.kashif)", // Select all textarea exluding the mceNoEditor class
            height: 800,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            mobile: {
                theme: 'mobile'
            },
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tiny.cloud/css/codepen.min.css'
            ],
        });
        //# sourceURL=pen.js
    </script>

<script>
    $(document).ready(function() {
        // Handle CCTV button click
        $('#cctvBtn').click(function() {
          const editorContent = tinymce.activeEditor.getContent({ format: 'html' });
          alert(editorContent);
          $('#notes').val("");
        });

        // Handle POS button click
        
    });
 </script>

    <div class="mt-2"><button type="submit"
            class="btn btn-success w-md float-right">Save</button>
        <a href="{{ URL('/Estimate') }}"
            class="btn btn-secondary w-md float-right">Cancel</a>

    </div>







</div>