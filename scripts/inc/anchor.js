class se2_Anchor {
    constructor() {
        this.PARAM = location.search.split('anchor=')[1]
        if(this.PARAM) {
            this.PARAM = this.PARAM.split('&')[0]
        }
    }

    goTO( targetID = false ) {
        var TARGET = (targetID) ? targetID : this.PARAM;
        if( document.getElementById(TARGET) ){
            document.getElementById(TARGET).scrollIntoView({ behavior: 'smooth', block: 'center'})
        }
    }

}