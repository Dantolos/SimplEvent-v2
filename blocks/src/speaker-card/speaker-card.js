import { useState } from 'react';

const { registerBlockType } = wp.blocks;
import {
     useBlockProps,
     InnerBlocks,
     InspectorControls,
     AlignmentToolbar,
     BlockAlignmentToolbar,
     BlockControls,
     Animate
} from '@wordpress/block-editor';
const { PanelBody, TabPanel, Spinner } = wp.components;
import apiFetch from '@wordpress/api-fetch';
import SE2_speaker from '../components/speaker';

registerBlockType('se2block/speaker-card', {

     "apiVersion": 2,
     title: 'Speaker Card',
     description: 'Create a Speaker Card',
     icon: 'businessperson',
     category: 'se2',


     //attributes
     attributes: {
          alignment: 'right',
          jahre: { type: 'object' },
          selectedjahr: { type: 'string' },
          speakers: { type: 'object' },
          selectedspeaker: { type: 'object', default: { id: '' } },
          alignment: {
               type: 'string',
               default: 'center'
          },
     },


     //built-in functions
     edit({ attributes, setAttributes }) {

          function fetchSpeakerData(filter, speakerDataCallback) {
               wp.apiFetch({
                    url: `/wp-json/wp/v2/speakers${filter}`
               }).then(fetchedData => {
                    console.info('Data Fetched:', fetchedData)
                    speakerDataCallback(fetchedData)
               }).catch(error => console.warn('Data Fetch Error:', error))
          }


          if (!attributes.speakers) {
               /*  let jahrFilter = attributes.selectedjahr ? `?jahr=${attributes.selectedjahr}` : ''; */
               fetchSpeakerData('', (data) => {
                    setAttributes({ speakers: data })
               })
          }

          if (!attributes.speakers) {
               return (
                    <div className="se2-block-speaker" style={{ backgroundColor: 'rgba(200,200,200,0.6)', display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                         <div style={{ height: '60px', width: '60px', borderRadius: '50%', backgroundColor: 'lightgrey', display: 'flex', alignItems: 'center' }}><Spinner /></div>
                         <h5>Loading <strong>...</strong></h5>
                    </div>
               )
          }

          if (attributes.speakers && attributes.speakers.length === 0) {
               return 'No speaker found...please add some!'
          }

          function updateSpeaker(e) {
               let speakerID = `/${e.target.value}`;
               fetchSpeakerData(speakerID, (data) => {
                    setAttributes({ selectedspeaker: data })
               })

          }

          var alignment = attributes.alignment
          const onChangeAlignment = (newAlignment) => {
               console.log(newAlignment)
               switch (newAlignment) {
                    case 'left':
                         setAttributes({ alignment: 'flex-start' });
                         break;
                    case 'center':
                         setAttributes({ alignment: 'center' });
                         break;
                    case 'right':
                         setAttributes({ alignment: 'flex-end' });
                         break;
                    default:
                         setAttributes({ alignment: 'center' });
                         break;
               }
          };

          const blockProps = useBlockProps()

          return (
               <>
                    <BlockControls key="controls">
                         <BlockAlignmentToolbar
                              value={alignment}
                              onChange={onChangeAlignment} />
                    </BlockControls>
                    <InspectorControls style={{ marginBottom: '40px' }} >

                         <p>Speakers</p>
                         <select onChange={updateSpeaker} value={attributes.selectedspeaker.id}>
                              {
                                   attributes.speakers.map(speaker => {
                                        return (
                                             <option value={speaker.id} key={speaker.id}>{speaker.title.rendered}</option>
                                        )
                                   })
                              }
                         </select>
                    </InspectorControls>
                    <div  {...blockProps}>
                         <div style={{ width: '100%', height: 'auto', display: 'flex', flexDirection: 'column', alignItems: alignment }}>
                              <SE2_speaker speakerdata={attributes.selectedspeaker} />
                         </div>
                    </div>
               </>
          );
     },

     save({ attributes, setAttributes }) {
          const blockProps = useBlockProps.save();

          return (
               <div style={{ width: '100%', height: 'auto', display: 'flex', flexDirection: 'column', alignItems: attributes.alignment }} >
                    <SE2_speaker speakerdata={attributes.selectedspeaker} />
               </div>
          )
     },


});

