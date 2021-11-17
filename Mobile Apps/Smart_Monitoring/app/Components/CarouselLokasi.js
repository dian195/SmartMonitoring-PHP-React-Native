import React, {useRef, useState, useEffect, Component} from 'react';
import Carousel, {ParallaxImage, Pagination} from 'react-native-snap-carousel';
import {
  View,
  Text,
  Dimensions,
  StyleSheet,
  TouchableOpacity,
  Platform,
  Image,
  ScrollView,
  SafeAreaView,
  TouchableWithoutFeedback,
  Button,
} from 'react-native';
import {
  Header,
  LearnMoreLinks,
  Colors,
  DebugInstructions,
  ReloadInstructions,
} from 'react-native/Libraries/NewAppScreen';
import {ScrollView as GestureHandlerScrollView} from 'react-native-gesture-handler';
import _ from 'lodash';

interface State {
  outerScrollViewScrollEnabled: boolean;
}

const {width: screenWidth, height: screenHeight} = Dimensions.get('window');

export default class CarouselLokasi extends Component {
  constructor(props) {
    super(props);
    this.state = {
      indexCrl: 0,
      outerScrollViewScrollEnabled: true,
      activeIndex: 0,
      carouselItems: [
        {
          id: '',
          lokasi_id: '',
          lokasi_name: '',
          Suhu_Udara: '0',
          kelembaban_Udara: '0',
          Suhu_Tanah: '0',
          Kelembaban_Tanah: '0',
          Ketinggian_Air: '0',
          Last_Update: '',
          Status_Lokasi: '-',
        },
      ],
      detailData: [
        {
          id: '',
          lokasi_id: '',
          lokasi_name: '',
          Suhu_Udara: '0',
          kelembaban_Udara: '0',
          Suhu_Tanah: '0',
          Kelembaban_Tanah: '0',
          Ketinggian_Air: '0',
          Last_Update: '',
          Status_Lokasi: '-',
        },
      ],
    };
  }

  componentDidMount() {
    this.getDataLokasi(0);
  }

  lokasiStyle = function (status) {
    if (status.toLowerCase() == 'waspada') {
      return {
        flex: 1,
        height: 40,
        marginTop: 5,
        //margin: 10,
        backgroundColor: '#FFCE45',
        borderRadius: 10,
        justifyContent: 'center',
        alignItems: 'center',
      };
    } else if (status.toLowerCase() == 'bahaya') {
      return {
        flex: 1,
        height: 40,
        marginTop: 5,
        //margin: 10,
        backgroundColor: '#FF0000',
        borderRadius: 10,
        justifyContent: 'center',
        alignItems: 'center',
      };
    } else {
      return {
        flex: 1,
        height: 40,
        marginTop: 5,
        //margin: 10,
        backgroundColor: '#29B671',
        borderRadius: 10,
        justifyContent: 'center',
        alignItems: 'center',
      };
    }
  };

  getDataLokasi(index) {
    console.log('Refresh Lokasi');
    this.setState({refreshing: true});
    fetch('http://161.117.253.209/smartmonitoring/api/monitoring/GetData.php')
      .then((res) => res.json())
      .then((resJson) => {
        this.setState({carouselItems: resJson});
        console.log(resJson);
      })
      .catch((e) => {
        console.log('Error : ' + e);
      });

    //load data
    console.log(index + 1);

    fetch('http://161.117.253.209/smartmonitoring/api/monitoring/GetData.php?lokasi_id=' + (index+1))
      .then((res) => res.json())
      .then((resJson) => {
        this.setState({detailData: resJson});
        console.log(resJson);
      })
      .catch((e) => {
        console.log('Error : ' + e);
      });
  }

  handleInnerPressIn = () =>
    this.setState({outerScrollViewScrollEnabled: false});
  handleInnerPressOut = () =>
    this.setState({outerScrollViewScrollEnabled: true});

  _renderItem({item, index}) {
    return (
      <>
        <View style={styles.headerData}>
          <View style={styles.headerLeftData}>
            <View style={styles.headerLeftDataContent}>
              <Text
                style={{
                  color: Colors.black,
                  marginTop: 10,
                  marginLeft: 10,
                }}>
                Lokasi : {item.lokasi_name}
              </Text>
              <Text
                style={{
                  color: Colors.black,
                  marginLeft: 10,
                }}>
                Last Update : {item.Last_Update}
              </Text>
            </View>
          </View>
          <View
            style={[
              styles.headerRightData,
              item.Status_Lokasi.toLowerCase() === 'aman'
                ? styles.headerRightData
                : item.Status_Lokasi.toLowerCase() === 'waspada'
                ? styles.headerRightDataWaspada
                : styles.headerRightDataBahaya,
            ]}>
            <View style={styles.headerRightDataContent}>
              <Text style={{color: Colors.white}}>{item.Status_Lokasi}</Text>
            </View>
          </View>
        </View>
      </>
    );
  }

  render() {
    const {outerScrollViewScrollEnabled} = this.state;

    return (
      <>
        <View style={styles.container}>
          <Carousel
            layout={'default'}
            ref={(ref) => (this.carousel = ref)}
            data={this.state.carouselItems}
            sliderWidth={screenWidth}
            sliderHeight={300}
            itemWidth={screenWidth - 30}
            renderItem={this._renderItem}
            nestedScrollEnabled={true}
            onSnapToItem={(index) => {
              this.setState({indexCrl: index});
              setTimeout(() => {
                this.getDataLokasi(index);
              }, 10);
            }}
          />
          <View>
            <Pagination
              dotsLength={this.state.carouselItems.length}
              activeDotIndex={this.state.indexCrl}
              dotStyle={{
                width: 10,
                height: 10,
                borderRadius: 5,
                marginHorizontal: 0,
                //backgroundColor: 'rgba(52, 52, 52, 0.8)',
              }}
              inactiveDotOpacity={0.4}
              inactiveDotScale={0.6}
              tappableDots={false}
            />
          </View>

          { this.renderItemData() }
          
        </View>
      </>
    );
  }

  renderItemData() {
    if (this.state.detailData && this.state.detailData.length) {
      return _.map(this.state.detailData, (item) => {
        return (
          <>
            <View style={styles.bodyData3}>
              <View style={styles.bodyCardData}>
                <View style={styles.bodyDataContent}>
                  <Text
                    style={{
                      color: Colors.black,
                      //fontWeight: 'bold',
                      margin: 10,
                    }}>
                    Temperature
                  </Text>
                  <Image
                    style={{width: 100, height: 100}}
                    source={require('../Images/Temperature.png')}
                  />
                  <Text
                    style={{
                      color: Colors.black,
                      //alignSelf: 'flex-end',
                      marginBottom: 5,
                      //fontSize: 18,
                      fontWeight: 'bold',
                    }}>
                    {item.Suhu_Udara}
                  </Text>
                </View>
              </View>

              <View style={styles.bodyCardData}>
                <View style={styles.bodyDataContent}>
                  <Text
                    style={{
                      color: Colors.black,
                      //fontWeight: 'bold',
                      margin: 10,
                    }}>
                    Humidity
                  </Text>
                  <Image
                    style={{width: 100, height: 100}}
                    source={require('../Images/humidity.png')}
                  />
                  <Text
                    style={{
                      color: Colors.black,
                      //alignSelf: 'flex-end',
                      //marginTop: 10,
                      marginBottom: 5,
                      //fontSize: 18,
                      fontWeight: 'bold',
                    }}>
                    {item.kelembaban_Udara}
                  </Text>
                </View>
              </View>
            </View>

            <View style={styles.bodyData2}>
              <View style={styles.bodyCardData}>
                <View style={styles.bodyDataContent}>
                  <Text
                    style={{
                      color: Colors.black,
                      //fontWeight: 'bold',
                      margin: 10,
                    }}>
                    Earth Temp
                  </Text>
                  <Image
                    style={{width: 100, height: 100}}
                    source={require('../Images/earth-temp.png')}
                  />
                  <Text
                    style={{
                      color: Colors.black,
                      //alignSelf: 'flex-end',
                      marginBottom: 5,
                      //marginRight: 10,
                      //fontSize: 18,
                      fontWeight: 'bold',
                    }}>
                    {item.Suhu_Tanah}
                  </Text>
                </View>
              </View>

              <View style={styles.bodyCardData}>
                <View style={styles.bodyDataContent}>
                  <Text
                    style={{
                      color: Colors.black,
                      //fontWeight: 'bold',
                      margin: 10,
                    }}>
                    Water Level
                  </Text>
                  <Image
                    style={{width: 100, height: 100}}
                    source={require('../Images/waterlevel.png')}
                  />
                  <Text
                    style={{
                      color: Colors.black,
                      //alignSelf: 'flex-end',
                      marginBottom: 5,
                      //marginRight: 10,
                      //fontSize: 18,
                      fontWeight: 'bold',
                    }}>
                    {item.Ketinggian_Air}
                  </Text>
                </View>
              </View>
            </View>
          </>
        );
      });
    }
  }
}

const styles = StyleSheet.create({
  container: {},

  ////Header
  headerData: {
    marginBottom: 10,
    marginLeft: 10,
    marginRight: 10,
    flex: 0.04,
    //backgroundColor: '#29B671',
    //borderRadius: 20,
    //height: 60,
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
  headerRightDataWaspada: {
    flex: 1,
    height: 40,
    marginTop: 5,
    //margin: 10,
    backgroundColor: '#FFCE45',
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },
  headerRightDataBahaya: {
    flex: 1,
    height: 40,
    marginTop: 5,
    //margin: 10,
    backgroundColor: '#FF0000',
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
  /// BODY Atas
  bodyData: {
    marginLeft: 10,
    marginRight: 10,
    marginBottom: 15,
    flex: 0,
    //backgroundColor: '#29B671',
    //borderRadius: 20,
    //height: 60,
    flexDirection: 'row',
    justifyContent: 'space-between',
    alignItems: 'center',
  },
  ///Body bawah
  bodyData2: {
    marginLeft: 10,
    marginRight: 10,
    marginTop: -10,
    flex: 0.01,
    //backgroundColor: '#29B671',
    //borderRadius: 20,
    //height: 60,
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
  },
  bodyData3: {
    marginLeft: 10,
    marginRight: 10,
    marginBottom: 15,
    flex: 0,
    //backgroundColor: '#29B671',
    //borderRadius: 20,
    //height: 60,
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
  },

  ///Content Body
  bodyCardData: {
    marginLeft: 10,
    marginRight: 10,    
    marginBottom: 5,
    justifyContent: 'space-between',
    //marginRight: 10,
    //height: 170,
    //width: 120,
    backgroundColor: '#fff7f6',
    borderRadius: 10,
  },
  bodyDataContent: {
    //width: '100%',
    //height: '100%',
    //justifyContent: 'center',
    justifyContent: 'center',
    alignItems: 'center',
    //backgroundColor: '#FFE2',
    borderRadius: 10,
  },
});
