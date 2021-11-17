import React, {useState, useEffect} from 'react';
import {View, Text} from 'react-native';
import RadioButton from './RadioButton';

export default function RadioButtonContainer({values, onPress, selected}) {
  const [currentSelectedItem, setCurrentSelectedItem] = useState(0);

  const _onPress = (idx) => {
    onPress(idx);
    setCurrentSelectedItem(idx);
  };

  const _renderRadioButtons = () => {
    return (values || []).map((listItem, idx) => {
      let isChecked = currentSelectedItem === listItem.value ? true : false;
      if (selected != null) {
        isChecked = selected === listItem.value ? true : false;
      }

      return (
        <RadioButton
          key={listItem.value}
          onRadioButtonPress={() => _onPress(listItem.value)}
          isChecked={isChecked}
          text={listItem.text}
          value={listItem.value}
        />
      );
    });
  };
  return <View>{_renderRadioButtons()}</View>;
}
