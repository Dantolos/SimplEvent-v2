
import { useState } from 'react';

import { ReactComponent as SlopeUp } from './shapes/slope-up.svg';
import { v4 as uuidv4 } from 'uuid';

import {
     __experimentalNumberControl as NumberControl,
     __experimentalBoxControl as BoxControl,

} from '@wordpress/components';
const { registerBlockType } = wp.blocks;
const {
     useBlockProps,
     InnerBlocks,
     InspectorControls,
     ColorPalette
} = wp.blockEditor;
const {
     PanelBody,
     Dropdown,
     MenuItem,
     MenuGroup,
     Button,
     RangeControl
} = wp.components;
import SE2_container from '../components/container';

const SectionEdit = ({ attributes, setAttributes }) => {
     console.log(attributes)
     let styleProps;
     if (attributes.containerstyle) {
          styleProps = attributes.containerstyle
     } else {
          styleProps = {}
     }

     function containerStyle(e, style) {
          setAttributes({
               containerstyle: e,
               style: style
          });
     }
     function handleShapeChange(e, position) {
          if (position === 'top') {
               setAttributes({ shapetop: e.target.getAttribute('shape') })
          }
          if (position === 'bottom') {
               setAttributes({ shapebottom: e.target.getAttribute('shape') })
          }
          for (const li of e.target.parentNode.childNodes) {
               li.style.backgroundColor = 'white'
          }
          //.map(li => { })
          e.target.style.backgroundColor = 'lightgrey'
          console.log(attributes)
     }

     function handleShapeColor(e, position) {
          console.log(attributes)
          if (position === 'top') {
               setAttributes({ shapetopcolor: e })
          }
          if (position === 'bottom') {
               setAttributes({ shapebottomcolor: e })
          }
     }
     const blockProps = useBlockProps();

     // Return the edit markup.
     return (
          <>
               <div {...blockProps}>

                    <SE2_container
                         {...blockProps}
                         key={'edit'}
                         styleHandler={containerStyle}
                         styleProps={styleProps}
                    >
                         <InnerBlocks allowedBlocks={true} renderAppender={InnerBlocks.ButtonBlockAppender} />
                    </SE2_container>
               </div>
          </>
     );

}

export default SectionEdit