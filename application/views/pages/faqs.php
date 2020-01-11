<?php require APPPATH.'views/inc/header.php' ; ?>
<?php require APPPATH.'views/inc/navbar.php' ; ?>

<section class="py-3 mt-4 faqs_section">
    <div class="container p-3">
            <h3>Frequently Asked Questions</h3>
            <div class="bottom-line"></div><br>
			<div class="accordion indicator-plus-before round-indicator" id="accordionH" aria-multiselectable="true">
				<div class="card m-b-0">
                    <?php $i = 0; ?>
                    <?php foreach($questions as $question): ?>
                        <div class="card-header collapsed" role="tab" id="heading<?= $i ?>" href="#collapse<?= $i ?>" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapse<?= $i ?>">
						<a class="card-title"><?= $question['title'];?></a>
                        </div>
                        <?php if($i == 0): ?>
                        <div class="collapse show" id="collapse<?= $i ?>" role="tabpanel" aria-labelledby="heading<?= $i ?>">
                            <div class="card-body">
                                 <?= $question['answer'];?>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="collapse" id="collapse<?= $i ?>" role="tabpanel" aria-labelledby="heading<?= $i ?>">
                            <div class="card-body">
                                 <?= $question['answer'];?>
                            </div>
                        </div>
                    <?Php endif; ?>
                    <?php $i++; ?>
                    <?php endforeach; ?>
				</div>
            </div>	
           <div class="message_box mb-3">
           <center>
                <a href="<?= base_url(). 'pages/contact'; ?>"><p>Have Any Question? Email Us</p></a>
            </center>
           </div>
        </div>
</section>
<script>
    $( '.closeall' ).click( function( e ) {
	e.preventDefault();
	$( '.accordion .collapse.show' ).collapse( 'hide' );
	return false;
    } );
    $( '.openall' ).click( function( e ) {
        e.preventDefault();
        $( '.accordion .collapse' ).collapse( 'show' );
        return false;
    } );

    if ( window.location.hash ) {
        redirect( window.location.hash );
    }

    $( 'a[href^="#"]' ).on( 'click', function( e ) {
        e.preventDefault();
        var a = document.createElement( 'a' );
            a.href = this.href;
        redirect ( a.hash );
        return false;
    } );

    function redirect( hash ) {
        // $( hash ).attr( 'aria-expanded', 'true' ).focus();
        // $( hash + '+div.collapse' ).addClass( 'show' ).attr( 'aria-expanded', 'true' );
        $( hash + '+div.collapse' ).collapse( 'show' );

        // using this because of static nav bar space
        $( 'html, body' ).animate( {
            scrollTop: $( hash ).offset().top - 60
        }, 10, function() {
        // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
        } );
    }

    document.documentElement.setAttribute("lang", "en");
    document.documentElement.removeAttribute("class");

    axe.run( function(err, results) {
    console.log( results.violations );
    } );

</script>
<?php require APPPATH.'views/inc/main-footer.php' ; ?>
<?php require APPPATH.'views/inc/footer.php' ; ?>

