import React, { Component } from 'react'

export default class speaker extends Component {

     constructor(props) {
          super(props)
          if (this.props.speakerdata.id) {
               this.state = { speaker: this.props.speakerdata }
          } else {
               this.state = {
                    speaker: {
                         acf: {
                              id: '',
                              speaker_vorname: 'Bitte einen Referenten auswählen!',
                              speaker_nachname: '',
                              speaker_bild: '',
                              speaker_funktion: '',
                              speaker_firma: ''
                         }
                    }
               }
          }


     }
     componentDidUpdate(prevProps) {
          console.log('changed:', prevProps, 'to:', this.props)
          if (prevProps.speakerdata.id !== this.props.speakerdata.id) {
               this.setState({
                    speaker: this.props.speakerdata
               });
          }
     }

     render(props) {

          if (this.state.speaker.acf === undefined) {
               console.warn('SE2: SPEAKERDATA NOT FOUND')
               return 'searching speaker data...'
          }
          const {
               speaker_vorname,
               speaker_nachname,
               speaker_bild,
               speaker_funktion,
               speaker_firma
          } = this.state.speaker.acf;

          let speaker_bild_url = `url(${speaker_bild})`
          return (

               <>
                    {console.log('this.props.speakerdata', this.props.speakerdata)}
                    <div style={{ height: '60px', width: '60px', borderRadius: '50%', overflow: 'hidden' }}>
                         <img src={speaker_bild} width="100%" alt={`${speaker_vorname}_${speaker_nachname}`} title={`${speaker_vorname}_${speaker_nachname}`} />
                    </div>
                    <h4>{speaker_vorname} <strong>{speaker_nachname}</strong></h4>
                    <p>{speaker_funktion}, {speaker_firma}</p>
               </>

          )
     }
}
