// REPLACED BY BOXCONTROL
// example:
// <SE2_spacing key="padding" spacingType="padding" spacingProps={this.state.padding} changeHandler={this.changeSettings} />
import React, { Component, useState } from 'react';

import { __experimentalNumberControl as NumberControl } from '@wordpress/components';
const {
     RichText,
     InspectorControls,
} = wp.blockEditor;
const { PanelBody } = wp.components;

export default class SE2_spacing extends Component {

     constructor(props) {
          super(props)
          let defaultStyle = {
               top: 0,
               right: 0,
               bottom: 0,
               left: 0
          }
          if (Object.values(this.props.spacingProps).length > 0) {
               var spacing = this.props.spacingProps
               this.state = Object.assign({}, spacing);

          } else {
               this.state = defaultStyle;
          }
     }

     changeMargin(e, d) {
          this.setState(
               (prevState) => {
                    var newState = Object.assign({}, prevState);
                    newState[d] = e
                    //newState = Object.assign(this.state[d], e);
                    return newState;
               },
               () => { this.props.changeHandler(this.state, this.props.spacingType) }
          )
          console.log('MARGIN', this.state)
     }


     render() {
          const panelStyle = {
               display: "flex",
               flexWrap: 'wrap',
               marginBottom: '10px',
               backgroundColor: '#f1f1f1',
               borderRadius: '3px',
               padding: '4px'
          }
          return ([

               <div style={panelStyle}>
                    <p style={{ width: "100%" }}>Set <b>{this.props.spacingType}</b> of this block:</p>
                    <div style={{ width: '25%' }}>
                         <NumberControl
                              label="Top"
                              onChange={value => { this.changeMargin(value, 'top') }}
                              isDragEnabled
                              isShiftStepEnabled
                              shiftStep={1}
                              step={1}
                              value={this.state.top}
                         />
                    </div>
                    <div style={{ width: '25%' }}>
                         <NumberControl
                              label="Right"
                              onChange={value => { this.changeMargin(value, 'right') }}
                              isDragEnabled
                              isShiftStepEnabled
                              shiftStep={1}
                              step={1}
                              value={this.state.right}
                         />
                    </div>
                    <div style={{ width: '25%' }}>
                         <NumberControl
                              label="Bottom"
                              onChange={value => { this.changeMargin(value, 'bottom') }}
                              isDragEnabled
                              isShiftStepEnabled
                              shiftStep={1}
                              step={1}
                              value={this.state.bottom}
                         />
                    </div>
                    <div style={{ width: '25%' }}>
                         <NumberControl
                              label="Left"
                              onChange={value => { this.changeMargin(value, 'left') }}
                              isDragEnabled
                              isShiftStepEnabled
                              shiftStep={1}
                              step={1}
                              value={this.state.left}
                         />
                    </div>
               </div>



          ])
     }
}