import * as React from 'react';
import 'react-native-gesture-handler';
import {NavigationContainer} from '@react-navigation/native';
import {createBottomTabNavigator} from '@react-navigation/bottom-tabs';
import Icon from 'react-native-vector-icons/Ionicons';

const Tab = createBottomTabNavigator();

export default function App() {
    return (
        <NavigationContainer>
            <Tabs.Navigator
                initialRouteName="Home"
                shifting={true}
                labeled={false}
                sceneAnimationEnabled={false}
                activeColor="#00aea2"
                inactiveColor="#95a5a6"
                barStyle={{ backgroundColor: '#00aea2' }}>
                <Tabs.Screen 
                    activeColor="#00aea2"
                    inactiveColor="red"
                    name="Home" 
                    component={HomeScreen}
                    options={{
                        tabBarLabel :({}) => (
                            <View style={styles.iconContainer}>
                                { /*<Icon name="ios-home" color="#000" size={18}></Icon> */ }
                                <Text>Home</Text>
                            </View>
                        ),
                    }}
                    >
                </Tabs.Screen>
            </Tabs.Navigator>
            <Tabs.Navigator
                initialRouteName="Chart"
                shifting={true}
                labeled={false}
                sceneAnimationEnabled={false}
                activeColor="#00aea2"
                inactiveColor="#95a5a6"
                barStyle={{ backgroundColor: '#00aea2' }}>
                <Tabs.Screen 
                    activeColor="#00aea2"
                    inactiveColor="red"
                    name="Chart" 
                    component={HomeScreen}
                    options={{
                        tabBarLabel :({}) => (
                            <View style={styles.iconContainer}>
                                { /*<Icon name="ios-home" color="#000" size={18}></Icon> */ }
                                <Text>Chart</Text>
                            </View>
                        ),
                    }}
                    >
                </Tabs.Screen>
            </Tabs.Navigator>
        </NavigationContainer>
    );
}


const styles = StyleSheet.create({
    iconContainer: {
        justifyContent: 'center',
        alignContent: 'center',
        alignItems: 'center'
    }
});