var AJAX = new se2_Ajax();
var seREST = new seREST();

class Lightbox {


    constructor() {
        this.LB_body = document.getElementsByTagName('body');
        this.LB_output;
        this.LB_closerCross_svg = '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 20 20" style="enable-background:new 0 0 20 20;" xml:space="preserve"><style type="text/css"> .st0{fill:none;stroke:#FFFFFF;stroke-linecap:round;stroke-miterlimit:10;}</style><g>   <line class="st0" x1="0.5" y1="0.5" x2="19.5" y2="19.5"/></g><g> <line class="st0" x1="19.5" y1="0.5" x2="0.5" y2="19.5"/></g></svg>';
        this.LB_svg_arrowRight = '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 11 20" style="enable-background:new 0 0 11 20;" xml:space="preserve"><style type="text/css"> .st0{fill:none;stroke:#FFFFFF;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}</style><g> <polyline class="st0" points="0.5,19.5 10,10 0.5,0.5 	"/></g></svg>';
        this.LB_svg_arrowLeft = '<svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 11 20" style="enable-background:new 0 0 11 20;" xml:space="preserve"><style type="text/css"> .st0{fill:none;stroke:#000000;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}</style><g>   <polyline class="st0" points="10.5,0.5 1,10 10.5,19.5"/></g></svg>';
    }


    openLightbox(type, data, contentArray, layered = false) {

        //check
        if (!type || !data) {
            console.watn('type or data missed!')
            return;
        }
        if (document.querySelector('.se-lightbox-container') && !layered) {
            return;
        }



        //create LB Container       
        this.LB_output = document.createElement('DIV');
        this.LB_output.classList.add('se-lightbox-container');


        document.body.appendChild(this.LB_output);

        //create LB CloseBackground
        this.LB_CloseBackground = document.createElement('DIV');
        this.LB_CloseBackground.classList.add('se-lightbox-closerBackground');
        this.LB_output.appendChild(this.LB_CloseBackground);

        //create LB CloseCross
        this.LB_CloseCross = document.createElement('DIV');
        this.LB_CloseCross.classList.add('se-lightbox-closerCross');
        this.LB_CloseCross.innerHTML = this.LB_closerCross_svg;
        this.LB_output.appendChild(this.LB_CloseCross);


        //create LB arrows
        if (contentArray !== undefined) {
            if (contentArray.length > 1) {
                this.LB_arrowLeft = document.createElement('DIV');
                this.LB_arrowLeft.classList.add('se-lightbox-arrowLeft');
                this.LB_arrowLeft.innerHTML = this.LB_svg_arrowLeft;
                this.LB_arrowRight = document.createElement('DIV');
                this.LB_arrowRight.classList.add('se-lightbox-arrowRight');
                this.LB_arrowRight.innerHTML = this.LB_svg_arrowRight;
                this.LB_output.appendChild(this.LB_arrowLeft);
                this.LB_output.appendChild(this.LB_arrowRight);
            }
        }


        //add Eventlistener for Closing
        this.LB_CloseBackground.addEventListener('click', function () {
            closeLB();
        });
        this.LB_CloseCross.addEventListener('click', function () {
            closeLB();
        });


        var LB_Container = document.getElementsByClassName('se-lightbox-container');

        //add Eventlistener for Arrows
        if (contentArray !== undefined) {

            this.LB_arrowLeft.addEventListener('click', function () {
                arrowNavigation('L');
            });
            this.LB_arrowRight.addEventListener('click', function () {
                arrowNavigation('R');
            });
        }
        //add keyboard navigation
        window.addEventListener('keydown', function () {
            //close
            if (window.event.key == 'Escape') {
                closeLB();
                return;
            };
            //arrows
            if (contentArray !== undefined) {
                if (window.event.key == 'ArrowRight' || window.event.key == 'ArrowDown') {
                    arrowNavigation('R');
                    return;
                }
                if (window.event.key == 'ArrowLeft' || window.event.key == 'ArrowUp') {
                    arrowNavigation('L');
                    return;
                }
            }
        });


        //-------------LB Types--------------
        //create img LB 
        if (type == 'IMG') {
            this.LB_IMG = document.createElement('IMG');
            this.LB_IMG.classList.add('se-lightbox-IMG');
            this.LB_IMG.src = data;
            this.LB_output.appendChild(this.LB_IMG);
        }

        //create AX LB
        if (type == 'AX') {
            AJAX.call_Ajax(data, this.LB_output.getAttribute('class'))
        }

        //create api LB
        if (type == 'api') {
            seREST.callRestAPI( data, 'lightbox' )
        }

        //-------------LB Types--------------
        //Open Animation
        gsap.from(LB_Container, 0.2, { 'opacity': 0, 'scale': 1.05 });
        if (contentArray !== undefined) {
            gsap.from(this.LB_CloseCross, 0.8, { 'opacity': 0, 'scale': 0.1 });
            gsap.to(this.LB_CloseCross, 0.8, { 'opacity': 1 });
            if (contentArray.length > 1) {
                gsap.from([this.LB_arrowLeft, this.LB_arrowRight], 0.4, { 'opacity': 0, 'scale': 5 });
            }
        }

        //-------------FUNCTIONS------------ 
        //arrow function
        if (contentArray !== undefined) {
            var currentIMG = contentArray.indexOf(data);
            function arrowNavigation(direction) {
                var nextIMG;
                if (direction == 'R') {
                    nextIMG = ((currentIMG + 2) > contentArray.length) ? 0 : (currentIMG + 1);

                    gsap.from(document.getElementsByClassName('se-lightbox-arrowRight'), 0.5, { 'scale': 1.2 });
                    // gsap.from(document.getElementsByClassName('se-lightbox-IMG'), 0.5, { x: +80, 'opacity': 1 });
                }
                else if (direction == 'L') {
                    nextIMG = ((currentIMG - 1) < 0) ? (contentArray.length - 1) : (currentIMG - 1);
                    gsap.from(document.getElementsByClassName('se-lightbox-arrowLeft'), 0.5, { 'scale': 1.2 });
                    // gsap.from(document.getElementsByClassName('se-lightbox-IMG'), 0.5, { x: -80, 'opacity': 1 });
                }
                currentIMG = nextIMG;
                document.getElementsByClassName('se-lightbox-IMG')[0].src = contentArray[nextIMG];
            }
        }

        //close function
        function closeLB() {
            if (LB_Container) {
                gsap.to(LB_Container, 0.2, { 'opacity': 0, 'scale': 1.05 });
                setTimeout(function () {
                    for (let index = 0; index < LB_Container.length; index++) {
                        LB_Container[index].parentNode.removeChild(LB_Container[index]);

                    }
                    jQuery('.se-lightbox-container').remove();
                }, 200);
            }
        }


    }




}