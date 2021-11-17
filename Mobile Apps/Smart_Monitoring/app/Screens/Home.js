import {
  View,
  Text,
  StyleSheet,
  Switch,
  ScrollView,
  FlatList,
  TouchableOpacity,
  Image,
  Button,
  BackHandler,
  SafeAreaView,
  StatusBar,
  Dimensions,
} from 'react-native';
import React, {Component, useState} from 'react';
import {
  Header,
  LearnMoreLinks,
  Colors,
  DebugInstructions,
  ReloadInstructions,
} from 'react-native/Libraries/NewAppScreen';
import 'react-native-gesture-handler';
import {NavigationContainer} from '@react-navigation/native';
import {createBottomTabNavigator} from '@react-navigation/bottom-tabs';
import CarouselData from '../Components/CarouselComp';
import CarouselLokasi from '../Components/CarouselLokasi';

const {width: screenWidth} = Dimensions.get('window');

class Home extends Component {
  constructor(props) {
    super(props);
  }

  //Untuk diload pertama kali
  componentDidMount() {}

  render() {
    return (
      <View style={styles.container}>
        <View
          style={{
            height: 60,
            marginTop: 20,
            marginLeft: 15,
            marginRight: 15,
          }}>
          <Text style={{fontSize: 20, fontWeight: 'bold'}}>
            SMART MONITORING
          </Text>
          <Text style={{fontSize: 12, opacity: 0.3}}>
            Forestry Wildfire Response
          </Text>
        </View>
        <ScrollView
          contentContainerStyle={{
            //flexGrow: 1,
            //justifyContent: 'space-between',
          }}>
          <CarouselData />
          <CarouselLokasi />
        </ScrollView>
      </View>
    );
  }
}

export default Home;

const stylesError = StyleSheet.create({
  container: {
    justifyContent: 'center',
    alignItems: 'center',
    flex: 1,
    margin: 20,
  },
});

const styles = StyleSheet.create({
  bodyData: {
    margin: 10,
    //backgroundColor: '#29B671',
    borderRadius: 20,
    height: 60,
    flexDirection: 'row',
  },
  bodyCardData: {
    //flex: 1,
    marginRight: 10,
    height: 200,
    width: 120,
    backgroundColor: '#fff7f6',
    borderRadius: 10,
  },
  bodyDataContent: {
    width: '100%',
    height: '100%',
    //justifyContent: 'center',
    alignItems: 'center',
    //backgroundColor: '#FFE2',
    borderRadius: 10,
  },
  headerData: {
    margin: 10,
    //backgroundColor: '#29B671',
    borderRadius: 20,
    height: 60,
    flexDirection: 'row',
  },
  headerRightData: {
    flex: 1,
    height: 40,
    marginTop: 5,
    //margin: 10,
    backgroundColor: '#29B671',
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  headerRightDataContent: {
    width: '100%',
    height: '100%',
    backgroundColor: '#FFE2',
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  headerLeftData: {
    flex: 3,
    marginRight: 10,
    //backgroundColor: '#29B671',
    borderRadius: 10,
  },
  headerLeftDataContent: {
    width: '100%',
    height: '100%',
    //backgroundColor: '#FFE2',
    borderRadius: 10,
  },
  cardData: {
    marginTop: -10,
    //backgroundColor: '#FFF7F5',
    borderRadius: 20,
    marginHorizontal: 5,
    width: screenWidth - 30,
    height: 305,
    marginLeft: 15,
    borderWidth: 1,
  },
  scrollView: {
    backgroundColor: Colors.lighter,
  },
  body: {
    backgroundColor: Colors.white,
  },
  sectionContainer: {
    marginTop: 32,
    paddingHorizontal: 24,
  },
  sectionTitle: {
    fontSize: 24,
    fontWeight: '600',
    color: Colors.black,
  },
  sectionDescription: {
    marginTop: 8,
    fontSize: 18,
    fontWeight: '400',
    color: Colors.dark,
  },
  highlight: {
    fontWeight: '700',
  },
  footer: {
    color: Colors.dark,
    fontSize: 12,
    fontWeight: '600',
    padding: 4,
    paddingRight: 12,
    textAlign: 'right',
  },
  container: {
    flex: 1,
    backgroundColor: '#FFF',
  },
  stage: {
    backgroundColor: '#EFEFF4',
    paddingTop: 20,
    paddingBottom: 20,
  },
  listItem: {
    margin: 10,
    padding: 10,
    backgroundColor: '#F0F8FF',
    width: '100%',
    flex: 1,
    alignSelf: 'center',
    flexDirection: 'row',
    borderRadius: 10,
  },
});
