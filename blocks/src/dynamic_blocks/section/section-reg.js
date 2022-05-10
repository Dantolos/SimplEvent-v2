import { useState } from 'react';

import { registerBlockType } from '@wordpress/blocks';
import { useSelect } from '@wordpress/data';
import SectionEdit from './section-editor';


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

registerBlockType('se2/section', {
     title: 'Section v2',
     description: 'Container to contain and design!',
     category: 'se2',
     icon: 'superhero',

     edit: ({ attributes, setAttributes }) => {

          function containerStyle(e, style) {
               setAttributes({
                    containerstyle: e,
                    style: style
               });
          }

          const blockProps = useBlockProps();

          return (
               <>
                    <SE2_container styleProps={attributes.containerstyle} styleHandler={containerStyle}>
                         <InnerBlocks allowedBlocks={true} renderAppender={InnerBlocks.ButtonBlockAppender} />
                    </SE2_container>
               </>
          );

     },

     save: props => <InnerBlocks.Content />

});