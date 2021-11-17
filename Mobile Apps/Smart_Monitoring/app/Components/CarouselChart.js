import React, {useRef, useState, useEffect, Component, createRef} from 'react';
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
  FlatList,
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
import {
  LineChart,
  BarChart,
  PieChart,
  ProgressChart,
  ContributionGraph,
  StackedBarChart,
} from 'react-native-chart-kit';
import Icons from 'react-native-vector-icons/AntDesign';
import ActionSheet from 'react-native-actions-sheet';
import RadioButtonContainer from './RadioButtonContainer';

const actionSheetRef = createRef();
const actionSheetRefSensor = createRef();
const actionSheetRefPeriode = createRef();

const {width: screenWidth, height: screenHeight} = Dimensions.get('window');

export default class CarouselChart extends Component {
  componentDidMount() {
    this.getDataFilterLokasi();
    this.getGrafik(
      this.state.dataselect,
      this.state.dataselectPeriode,
      this.state.dataselectSensor,
    );
  }

  getGrafik(lokasi, period, sensor) {
    console.log(lokasi);
    console.log(period);
    console.log(sensor);

    //if (this.state.dataselectPeriode === 'Tahunan') {
    if (period === 'Tahunan') {
      console.log('Refresh');
      this.setState({refreshing: true});
      //10.0.2.2:7788
      fetch(
        'http://161.117.253.209/smartmonitoring/api/mobile/chart/GetDataTahunan.php?lokasi_id=' +
          lokasi +
          '&kategori=' +
          sensor,
      )
        .then((res) => res.json())
        .then((resJson) => {
          this.setState({dataTahunan: resJson});
          console.log(resJson);

          if (lokasi == '-' || lokasi == '') {
            this.setState({
              datasetTahunan: [
                {
                  data: resJson[0].data,
                  strokeWidth: 1,
                  color: (opacity = 1) => `rgba(255,0,0,${opacity})`, // optional
                },
              ],
            });
          } else {
            if (sensor === 'Semua Sensor') {
              this.setState({
                datasetTahunan: [
                  {
                    data: resJson[0].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(255, 99, 132, ${opacity})`, // optional
                  },
                  {
                    data: resJson[1].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(54, 162, 235, ${opacity})`, // optional
                  },
                  {
                    data: resJson[2].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(255, 206, 86, ${opacity})`, // optional
                  },
                  {
                    data: resJson[3].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(75, 192, 192, ${opacity})`, // optional
                  },
                  {
                    data: resJson[4].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(153, 102, 255, ${opacity})`, // optional
                  },
                ],
              });
            } else {
              if (sensor == 'Temperature') {
                this.setState({
                  datasetTahunan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(255, 99, 132, ${opacity})`, // optional
                    },
                  ],
                });
              } else if (sensor == 'Humidity') {
                this.setState({
                  datasetTahunan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(54, 162, 235, ${opacity})`, // optional
                    },
                  ],
                });
              } /*else if (sensor == 'Soil Moisture') {
                this.setState({
                  datasetTahunan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(255, 206, 86, ${opacity})`, // optional
                    },
                  ],
                });
              }*/ else if (sensor == 'Earth Temperature') {
                this.setState({
                  datasetTahunan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(75, 192, 192, ${opacity})`, // optional
                    },
                  ],
                });
              } else {
                this.setState({
                  datasetTahunan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(153, 102, 255, ${opacity})`, // optional
                    },
                  ],
                });
              }
            }
          }
        })
        .catch((e) => {
          console.log('Error : ' + e);
        });
    } else {
      fetch(
        'http://161.117.253.209/smartmonitoring/api/mobile/chart/GetDataMingguan.php?lokasi_id=' +
          lokasi +
          '&kategori=' +
          sensor,
      )
        .then((res) => res.json())
        .then((resJson) => {
          this.setState({dataMingguan: resJson});
          console.log(resJson);

          if (lokasi == '-' || lokasi == '') {
            this.setState({
              datasetMingguan: [
                {
                  data: resJson[0].data,
                  strokeWidth: 1,
                  color: (opacity = 1) => `rgba(255,0,0,${opacity})`, // optional
                },
              ],
            });
          } else {
            if (sensor === 'Semua Sensor') {
              this.setState({
                datasetMingguan: [
                  {
                    data: resJson[0].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(255, 99, 132, ${opacity})`, // optional
                  },
                  {
                    data: resJson[1].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(54, 162, 235, ${opacity})`, // optional
                  },
                  {
                    data: resJson[2].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(255, 206, 86, ${opacity})`, // optional
                  },
                  {
                    data: resJson[3].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(75, 192, 192, ${opacity})`, // optional
                  },
                  {
                    data: resJson[4].data,
                    strokeWidth: 5,
                    color: (opacity = 1) => `rgba(153, 102, 255, ${opacity})`, // optional
                  },
                ],
              });
            } else {
              if (sensor == 'Temperature') {
                this.setState({
                  datasetMingguan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(255, 99, 132, ${opacity})`, // optional
                    },
                  ],
                });
              } else if (sensor == 'Humidity') {
                this.setState({
                  datasetMingguan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(54, 162, 235, ${opacity})`, // optional
                    },
                  ],
                });
              } /*else if (sensor == 'Soil Moisture') {
                this.setState({
                  datasetMingguan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(255, 206, 86, ${opacity})`, // optional
                    },
                  ],
                });
              }*/ else if (sensor == 'Earth Temperature') {
                this.setState({
                  datasetMingguan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(75, 192, 192, ${opacity})`, // optional
                    },
                  ],
                });
              } else {
                this.setState({
                  datasetMingguan: [
                    {
                      data: resJson[0].data,
                      strokeWidth: 5,
                      color: (opacity = 1) => `rgba(153, 102, 255, ${opacity})`, // optional
                    },
                  ],
                });
              }
            }
          }
        })
        .catch((e) => {
          console.log('Error : ' + e);
        });
    }
  }

  getDataFilterLokasi() {
    console.log('Refresh Lokasi');
    this.setState({refreshing: true});
    fetch(
      'http://161.117.253.209/smartmonitoring/api/mobile/filter/GetFilterLokasi.php',
    )
      .then((res) => res.json())
      .then((resJson) => {
        this.setState({dataFilterLokasi: resJson});
        console.log(resJson);
      })
      .catch((e) => {
        console.log('Error : ' + e);
      });
  }

  constructor(props) {
    super(props);
    this.state = {
      dataMingguan: [],
      dataTahunan: [],
      dataselect: '',
      dataselectSensor: 'Semua Sensor',
      dataselectPeriode: 'Mingguan',
      dataFilterLokasi: [],
      dataFilterSensor: [
        {
          text: 'Semua Sensor',
          value: 'Semua Sensor',
        },
        {
          text: 'Temperature',
          value: 'Temperature',
        },
        {
          text: 'Humidity',
          value: 'Humidity',
        },
        /*{
          text: 'Soil Moisture',
          value: 'Soil Moisture',
        },*/
        {
          text: 'Earth Temperature',
          value: 'Earth Temperature',
        },
        {
          text: 'Water Level',
          value: 'Water Level',
        },
      ],
      dataFilterPeriode: [
        {
          text: 'Mingguan',
          value: 'Mingguan',
        },
        {
          text: 'Tahunan',
          value: 'Tahunan',
        },
      ],
      refreshing: false,
      datasetTahunan: [
        {
          data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
          strokeWidth: 1,
          color: (opacity = 1) => `rgba(255,0,0,${opacity})`, // optional
        },
      ],
      datasetMingguan: [
        {
          data: [0, 0, 0, 0, 0, 0, 0],
          strokeWidth: 1,
          color: (opacity = 1) => `rgba(255,0,0,${opacity})`, // optional
        },
      ],
    };
  }

  onRadioButtonPress = (itemIdx) => {
    this.setState({dataselect: itemIdx}, () => {
      dataselect: itemIdx;
    });
    this.getGrafik(
      itemIdx,
      this.state.dataselectPeriode,
      this.state.dataselectSensor,
    );
    actionSheetRef.current?.setModalVisible();
  };

  onRadioButtonPressSensor = (itemIdx) => {
    this.setState({dataselectSensor: itemIdx}),
      () => {
        dataselectSensor: itemIdx;
      };
    this.getGrafik(
      this.state.dataselect,
      this.state.dataselectPeriode,
      itemIdx,
    );
    actionSheetRefSensor.current?.setModalVisible();
  };

  onRadioButtonPressPeriode = (itemIdx) => {
    this.setState({dataselectPeriode: itemIdx}, () => {
      dataselectPeriode: itemIdx;
    });
    this.getGrafik(this.state.dataselect, itemIdx, this.state.dataselectSensor);
    actionSheetRefPeriode.current?.setModalVisible();
  };

  _renderGrafik() {
    if (this.state.dataselectPeriode === 'Tahunan') {
      return (
        <View style={styles.bodyData}>
          <LineChart
            data={{
              labels: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'Mei',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Okt',
                'Nov',
                'Dec',
              ],
              datasets: this.state.datasetTahunan,
            }}
            hideLegend={true}
            width={Dimensions.get('window').width - 30}
            height={320}
            yAxisSuffix=" "
            yAxisInterval={1}
            chartConfig={{
              backgroundColor: '#fff',
              backgroundGradientFrom: '#fff',
              backgroundGradientTo: '#fff',
              fillShadowGradientOpacity: 0,
              decimalPlaces: 0,
              color: (opacity = 0) => `rgba(255,0,0, ${opacity})`,
              labelColor: (opacity = 0) => `rgba(0,0,0, ${opacity})`,
              style: {
                borderRadius: 1,
              },
              useShadowColorFromDataset: true, // optional,
              backgroundGradientToOpacity: 0.5,
              propsForDots: {
                r: '3',
                strokeWidth: '2',
                //stroke: '#ffa726',
              },
            }}
            bezier
            style={{
              marginVertical: 8,
              borderRadius: 1,
            }}
          />
        </View>
      );
    }

    if (this.state.dataselectPeriode === 'Mingguan') {
      return (
        <View style={styles.bodyData}>
          <LineChart
            data={{
              labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Ming'],
              datasets: this.state.datasetMingguan,
            }}
            hideLegend={true}
            width={Dimensions.get('window').width - 30}
            height={320}
            yAxisSuffix=" "
            yAxisInterval={1}
            chartConfig={{
              backgroundColor: '#fff',
              backgroundGradientFrom: '#fff',
              backgroundGradientTo: '#fff',
              fillShadowGradientOpacity: 0,
              decimalPlaces: 0,
              color: (opacity = 0) => `rgba(255,0,0, ${opacity})`,
              labelColor: (opacity = 0) => `rgba(0,0,0, ${opacity})`,
              style: {
                borderRadius: 1,
              },
              useShadowColorFromDataset: true, // optional,
              backgroundGradientToOpacity: 0.5,
              propsForDots: {
                r: '3',
                strokeWidth: '2',
                //stroke: '#ffa726',
              },
            }}
            bezier
            style={{
              marginVertical: 8,
              borderRadius: 1,
            }}
          />
        </View>
      );
    }
  }

  render() {
    let actionSheet;

    return (
      <>
        <View
          style={{
            flexDirection: 'column',
            flex: 0.001,
            //backgroundColor: '#3331',
          }}>
          <View
            style={{
              marginLeft: 10,
              marginRight: 10,
              flexDirection: 'row',
              flex: 1,
              justifyContent: 'flex-start',
              alignItems: 'center',
            }}>
            <Text style={{color: Colors.black, width: 50}}>Lokasi</Text>
            <TouchableOpacity
              onPress={() => {
                actionSheetRef.current?.setModalVisible();
              }}>
              <View style={styles.buttonSearch}>
                <Text style={{color: Colors.white}}>
                  <Icons name="search1" size={12} />
                </Text>
              </View>
            </TouchableOpacity>
            <Text>
              {this.state.dataselect === '' ? '-' : this.state.dataselect}
            </Text>
          </View>
          <View
            style={{
              marginLeft: 10,
              marginRight: 10,
              flexDirection: 'row',
              flex: 1,
              justifyContent: 'flex-start',
              alignItems: 'center',
            }}>
            <Text style={{color: Colors.black, width: 50}}>Sensor </Text>
            <TouchableOpacity
              onPress={() => {
                actionSheetRefSensor.current?.setModalVisible();
              }}>
              <View style={styles.buttonSearch}>
                <Text style={{color: Colors.white}}>
                  <Icons name="search1" size={12} />
                </Text>
              </View>
            </TouchableOpacity>
            <Text>
              {this.state.dataselectSensor === ''
                ? 'Semua Sensor'
                : this.state.dataselectSensor}
            </Text>
          </View>

          <View
            style={{
              marginLeft: 10,
              marginRight: 10,
              flexDirection: 'row',
              flex: 1,
              justifyContent: 'flex-start',
              alignItems: 'center',
            }}>
            <Text style={{color: Colors.black, width: 50}}>Periode </Text>
            <TouchableOpacity
              onPress={() => {
                actionSheetRefPeriode.current?.setModalVisible();
              }}>
              <View style={styles.buttonSearch}>
                <Text style={{color: Colors.white}}>
                  <Icons name="search1" size={12} />
                </Text>
              </View>
            </TouchableOpacity>
            <Text>
              {this.state.dataselectPeriode === ''
                ? 'Mingguan'
                : this.state.dataselectPeriode}
            </Text>
          </View>
        </View>

        <View style={styles.headerDataContainer}>{this._renderGrafik()}</View>

        <ActionSheet
          ref={actionSheetRef}
          containerStyle={{
            borderTopLeftRadius: 25,
            borderTopRightRadius: 25,
            borderBottomLeftRadius: 0,
            borderBottomRightRadius: 0,
          }}>
          <View style={styles.drawerContent}>
            <RadioButtonContainer
              values={this.state.dataFilterLokasi}
              onPress={this.onRadioButtonPress}
              selected={this.state.dataselect}
            />
          </View>
        </ActionSheet>

        <ActionSheet
          ref={actionSheetRefSensor}
          containerStyle={{
            borderTopLeftRadius: 25,
            borderTopRightRadius: 25,
            borderBottomLeftRadius: 0,
            borderBottomRightRadius: 0,
          }}>
          <View style={styles.drawerContent}>
            <RadioButtonContainer
              values={this.state.dataFilterSensor}
              onPress={this.onRadioButtonPressSensor}
              selected={this.state.dataselectSensor}
            />
          </View>
        </ActionSheet>

        <ActionSheet
          ref={actionSheetRefPeriode}
          containerStyle={{
            borderTopLeftRadius: 25,
            borderTopRightRadius: 25,
            borderBottomLeftRadius: 0,
            borderBottomRightRadius: 0,
          }}>
          <View style={styles.drawerContent}>
            <RadioButtonContainer
              values={this.state.dataFilterPeriode}
              onPress={this.onRadioButtonPressPeriode}
              selected={this.state.dataselectPeriode}
            />
          </View>
        </ActionSheet>
      </>
    );
  }
}

const styles = StyleSheet.create({
  container: {},
  container2: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
  drawerContent: {
    padding: 10,
    paddingHorizontal: 10,
    minHeight: 100,
  },
  ///Button
  button: {
    height: 25,
    margin: 5,
    width: '100%',
    backgroundColor: '#29B671',
    borderRadius: 10,
    justifyContent: 'center',
    alignItems: 'center',
  },

  buttonSearch: {
    height: 20,
    margin: 5,
    width: 20,
    backgroundColor: '#29B671',
    borderRadius: 20 / 2,
    justifyContent: 'center',
    alignItems: 'center',
  },

  filterPeriod: {
    flex: 1,
    marginTop: 20,
    backgroundColor: '#29F671',
    //borderRadius: 20,
    //height: 60,
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'center',
  },

  ////Header
  headerDataContainer: {
    flex: 1,
    marginTop: 10,
    //backgroundColor: '#29F671',
    //borderRadius: 20,
    //height: 60,
    flexDirection: 'column',
  },
  ////Header
  headerData: {
    marginBottom: 20,
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
    //backgroundColor: '#29B671',
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
    //marginBottom: 15,
    flex: 2,
    //backgroundColor: '#29B671',
    //borderRadius: 20,
    //height: 60,
    flexDirection: 'row',
    justifyContent: 'center',
    alignItems: 'flex-start',
  },

  ///Content Body
  bodyCardData: {
    marginLeft: 10,
    marginRight: 10,
    justifyContent: 'center',
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
  listItem: {
    margin: 5,
    padding: 10,
    width: '100%',
    flex: 1,
    alignSelf: 'center',
    flexDirection: 'row',
  },
});
